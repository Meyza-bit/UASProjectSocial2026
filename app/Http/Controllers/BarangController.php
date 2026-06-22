<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    // 1. Menampilkan Katalog Barang
    public function index()
    {
        return view('barang.index');
    }

    // 2. Menampilkan Form dari PM
    public function create()
    {
        return view('barang.create');
    }

    // 3. Menyimpan Data dari Form PM
    public function store(Request $request)
    {
        $request->validate([
            'program'           => 'required',
            'prioritas'         => 'required',
            'kategori'          => 'required',
            'nama_pengirim'     => 'required|string|max:255',
            'hp_pengirim'       => 'required|string|max:20',
            'alamat_pengirim'   => 'required|string',
            'ekspedisi'         => 'required',
            'berat'             => 'nullable|numeric|min:1',
            'barang'            => 'required|array|min:1',
            'barang.*.nama'     => 'required|string|max:255',
            'barang.*.jumlah'   => 'required|numeric|min:1',
            'barang.*.satuan'   => 'required|string',
        ]);

        // FIX: sebelumnya data hanya di-loop lalu dibuang, sekarang benar-benar disimpan
        $barang = Barang::create([
            'program'          => $request->program,
            'prioritas'        => $request->prioritas,
            'kategori'         => $request->kategori,
            'daftar_barang'    => $request->barang, // otomatis disimpan sebagai JSON
            'nama_pengirim'    => $request->nama_pengirim,
            'hp_pengirim'      => $request->hp_pengirim,
            'alamat_pengirim'  => $request->alamat_pengirim,
            'ekspedisi'        => $request->ekspedisi,
            'berat'            => $request->berat,
            'status'           => 'pending',
        ]);

        // FIX: sebelumnya redirect balik ke form, sekarang ke halaman konfirmasi/sukses
        return redirect()->route('barang.sukses', $barang->id);
    }

    // 4. FUNGSI BARU: menampilkan halaman terima kasih setelah data tersimpan
    public function sukses($id)
    {
        $pengiriman = Barang::findOrFail($id);
        return view('barang.barang-sukses', ['pengiriman' => $pengiriman]);
    }
}