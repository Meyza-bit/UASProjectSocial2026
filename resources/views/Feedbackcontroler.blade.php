<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // ════════════════════════════════════════════════════════
    // #16 — API endpoint feedback
    // ════════════════════════════════════════════════════════

    /**
     * GET /api/feedback
     * Ambil semua feedback milik user yang sedang login.
     */
    public function index()
    {
        $feedbacks = Feedback::with('user', 'program')
            ->where('id_user', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data'   => $feedbacks,
        ]);
    }

    /**
     * POST /api/feedback
     * Kirim feedback baru ke database.
     *
     * Body JSON:
     * {
     *   "id_program": 1,
     *   "rating": 5,
     *   "isi": "Program ini sangat bermanfaat!"
     * }
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_program' => 'required|exists:program_donasi,id',
            'rating'     => 'required|integer|min:1|max:5',
            'isi'        => 'required|string|min:10',
        ]);

        $feedback = Feedback::create([
            'id_user'    => Auth::id(),
            'id_program' => $request->id_program,
            'rating'     => $request->rating,
            'isi'        => $request->isi,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Feedback berhasil dikirim.',
            'data'    => $feedback->load('user', 'program'),
        ], 201);
    }

    /**
     * GET /api/feedback/{id}
     * Detail satu feedback milik user yang login.
     */
    public function show($id)
    {
        $feedback = Feedback::with('user', 'program')
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return response()->json([
            'status' => true,
            'data'   => $feedback,
        ]);
    }

    /**
     * PUT /api/feedback/{id}
     * Update feedback.
     */
    public function update(Request $request, $id)
    {
        $feedback = Feedback::where('id_user', Auth::id())->findOrFail($id);

        $request->validate([
            'rating' => 'sometimes|integer|min:1|max:5',
            'isi'    => 'sometimes|string|min:10',
        ]);

        $feedback->update($request->only('rating', 'isi'));

        return response()->json([
            'status'  => true,
            'message' => 'Feedback berhasil diperbarui.',
            'data'    => $feedback->fresh(),
        ]);
    }

    /**
     * DELETE /api/feedback/{id}
     * Hapus feedback.
     */
    public function destroy($id)
    {
        $feedback = Feedback::where('id_user', Auth::id())->findOrFail($id);
        $feedback->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Feedback berhasil dihapus.',
        ]);
    }

    // ════════════════════════════════════════════════════════
    // #17 — API endpoint transparansi
    // ════════════════════════════════════════════════════════

    /**
     * GET /api/transparansi
     * Tampilkan data transparansi publik:
     * feedback rating tinggi + statistik keseluruhan.
     *
     * Query params (opsional):
     *   ?id_program=1   → filter per program
     *   ?rating=5       → filter rating tertentu
     *   ?per_page=10    → jumlah per halaman
     */
    public function transparansi(Request $request)
    {
        $query = Feedback::ratingTinggi()
            ->with('user:id,name', 'program:id,nama')
            ->latest();

        // Filter opsional
        if ($request->filled('id_program')) {
            $query->where('id_program', $request->id_program);
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->integer('rating'));
        }

        $feedbacks = $query->paginate($request->integer('per_page', 10));

        // Statistik global
        $statistik = [
            'total_feedback'  => Feedback::count(),
            'rata_rata_rating' => round(Feedback::avg('rating'), 1),
            'total_bintang_5' => Feedback::where('rating', 5)->count(),
            'total_bintang_4' => Feedback::where('rating', 4)->count(),
        ];

        return response()->json([
            'status'    => true,
            'message'   => 'Data transparansi berhasil diambil.',
            'statistik' => $statistik,
            'data'      => $feedbacks,
        ]);
    }
}