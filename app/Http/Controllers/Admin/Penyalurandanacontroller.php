<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenyaluranDana;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyaluranDanaController extends Controller
{
    // Tampilin daftar penyaluran + form buat nambah baru
    public function index()
    {
        $penyaluran = PenyaluranDana::with('program')->latest('tanggal_penyaluran')->paginate(15);
        $programs   = ProgramDonasi::orderBy('judul')->get();

        return view('admin.penyaluran-dana', compact('penyaluran', 'programs'));
    }

    // Simpan data penyaluran baru
    public function store(Request $request)
    {
        $request->validate([
            'id_program'         => 'nullable|exists:program_donasi,id',
            'jumlah'              => 'required|integer|min:1000',
            'tanggal_penyaluran'  => 'required|date',
            'keterangan'          => 'nullable|string',
            'bukti_penyaluran'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_penyaluran')) {
            $path = $request->file('bukti_penyaluran')->store('penyaluran_bukti', 'public');
        }

        PenyaluranDana::create([
            'id_program'         => $request->id_program ?: null,
            'jumlah'             => $request->jumlah,
            'tanggal_penyaluran' => $request->tanggal_penyaluran,
            'keterangan'         => $request->keterangan,
            'bukti_penyaluran'   => $path,
        ]);

        return back()->with('success', 'Data penyaluran dana berhasil ditambahkan.');
    }

    // Hapus data penyaluran
    public function destroy(PenyaluranDana $penyaluran_dana)
    {
        if ($penyaluran_dana->bukti_penyaluran) {
            Storage::disk('public')->delete($penyaluran_dana->bukti_penyaluran);
        }

        $penyaluran_dana->delete();

        return back()->with('success', 'Data penyaluran dana berhasil dihapus.');
    }
}