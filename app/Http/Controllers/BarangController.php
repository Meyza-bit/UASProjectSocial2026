<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Validasi input agar data wajib diisi dengan benar
        $request->validate([
            'program'           => 'required',
            'prioritas'         => 'required',
            'kategori'          => 'required',
            'nama_pengirim'     => 'required|string|max:255',
            'hp_pengirim'       => 'required|string|max:20',
            'alamat_pengirim'   => 'required|string',
            'ekspedisi'         => 'required',
            'barang'            => 'required|array|min:1',
            'barang.*.nama'     => 'required|string|max:255',
            'barang.*.jumlah'   => 'required|numeric|min:1',
            'barang.*.satuan'   => 'required|string',
        ]);

        $namaPengirim = $request->input('nama_pengirim');
        $namaProgram = $request->input('program');

        // Mengambil array daftar barang dinamis yang ditambah lewat tombol JavaScript
        $daftarBarang = $request->input('barang');
        
        // Logika looping untuk membaca barang satu per satu
        foreach ($daftarBarang as $item) {
            $namaBarang   = $item['nama'];
            $jumlahBarang = $item['jumlah'];
            $satuanBarang = $item['satuan'];
            // (Siap dihubungkan ke Eloquent Model/Database jika tabel sudah ada)
        }

        // Kembali ke halaman form dengan pesan sukses kilat (flash session)
        return redirect()->route('barang.create')->with(
            'success', 
            "Terima kasih {$namaPengirim}! Data logistik untuk '{$namaProgram}' berhasil direkam."
        );
    }
}