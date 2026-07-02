<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{
    /**
     * Halaman Feedback: rangkuman kepuasan + form + dinding ulasan publik.
     */
    public function index(Request $request)
    {
        // ---- Query dinding ulasan publik (dengan search & filter) ----
        $query = Feedback::query()->latest();

        if ($request->filled('q')) {
            $query->where('isi', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('bintang')) {
            $query->where('rating', $request->bintang);
        }

        $feedbacks = $query->paginate(8)->withQueryString();

        // ---- Rangkuman kepuasan publik (dihitung dari SELURUH data, bukan hasil filter) ----
        $totalFeedback = Feedback::count();
        $avgRating     = $totalFeedback ? round(Feedback::avg('rating'), 1) : 0;

        $starPercents = [];
        for ($star = 5; $star >= 1; $star--) {
            $count = Feedback::where('rating', $star)->count();
            $starPercents[$star] = $totalFeedback ? round(($count / $totalFeedback) * 100) : 0;
        }

        $positiveCount = Feedback::whereIn('rating', [4, 5])->count();
        $satisfactionPercent = $totalFeedback ? round(($positiveCount / $totalFeedback) * 100) : 0;

        return view('feedback.index', compact(
            'feedbacks',
            'totalFeedback',
            'avgRating',
            'starPercents',
            'satisfactionPercent'
        ));
    }

    /**
     * Simpan feedback baru dari form, lalu redirect balik + pesan sukses.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'nullable|string|max:255',
            'anonim'   => 'nullable|boolean',
            'peran'    => ['required', Rule::in(['donatur', 'penerima', 'relawan', 'umum'])],
            'rating'   => 'required|integer|min:1|max:5',
            'kategori' => ['required', Rule::in(['transparansi', 'barang', 'layanan', 'website', 'lainnya'])],
            'isi'      => 'required|string|max:2000',
        ]);

        $anonim = $request->boolean('anonim');

        Feedback::create([
            'nama'     => $anonim ? null : $validated['nama'],
            'anonim'   => $anonim,
            'peran'    => $validated['peran'],
            'rating'   => $validated['rating'],
            'kategori' => $validated['kategori'],
            'isi'      => $validated['isi'],
            'verified' => false, // biar admin yang verifikasi manual kalau perlu
        ]);

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Terima kasih! Masukan kamu sudah tayang di Dinding Suara Publik.');
    }
}