<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenyaluranBarang;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyaluranBarangController extends Controller
{
    public function index()
    {
        $penyaluran = PenyaluranBarang::with('program')->latest('tanggal_penyaluran')->paginate(15);
        $programs   = ProgramDonasi::orderBy('judul')->get();

        return view('admin.penyaluran-barang', compact('penyaluran', 'programs'));
    }

  public function store(Request $request)
    {
        $request->validate([
            'id_program'         => 'nullable|exists:program_donasi,id',
            'nama_barang'        => 'required|string|max:255',
            'jumlah'             => 'required|integer|min:1',
            'satuan'             => 'required|string',
            'penerima'           => 'nullable|string|max:255',
            'keterangan'         => 'nullable|string',
            'tanggal_penyaluran' => 'required|date',
            'bukti_penyaluran'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_penyaluran')) {
            $path = $request->file('bukti_penyaluran')->store('bukti_penyaluran_barang', 'public');
        }

        PenyaluranBarang::create([
            'id_program'         => $request->id_program,
            'nama_barang'        => $request->nama_barang,
            'jumlah'             => $request->jumlah,
            'satuan'             => $request->satuan,
            'penerima'           => $request->penerima,
            'keterangan'         => $request->keterangan,
            'tanggal_penyaluran' => $request->tanggal_penyaluran,
            'bukti_penyaluran'   => $path,
        ]);

        return back()->with('success', 'Data penyaluran barang berhasil ditambahkan.');
    }

    public function destroy(PenyaluranBarang $penyaluran_barang)
    {
        if ($penyaluran_barang->bukti_penyaluran) {
            Storage::disk('public')->delete($penyaluran_barang->bukti_penyaluran);
        }

        $penyaluran_barang->delete();

        return back()->with('success', 'Data penyaluran barang berhasil dihapus.');
    }
}