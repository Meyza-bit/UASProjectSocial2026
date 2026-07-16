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
        // PERBAIKAN: Validasi 'program' dan 'prioritas' dihapus karena tidak ada di form HTML Anda
        $request->validate([
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
        
        // PERBAIKAN: Memberikan nilai default karena input program tidak ada di form HTML Anda
        $namaProgram = 'Program Donasi Logistik';

        // Mengambil array daftar barang dinamis yang ditambah lewat tombol JavaScript
        $daftarBarang = $request->input('barang');
        
        // Logika looping untuk membaca barang satu per satu
        foreach ($daftarBarang as $item) {
            $namaBarang   = $item['nama'];
            $jumlahBarang = $item['jumlah'];
            $satuanBarang = $item['satuan'];
        }

        // SESUAI ROUTE: Diarahkan ke 'barang.sukses' membawa ID acak dan data form lewat parameter URL
        return redirect()->route('barang.sukses', [
            'id'        => rand(100, 999), // ID referensi acak sementara
            'nama'      => $namaPengirim,
            'program'   => $namaProgram,
            'ekspedisi' => $request->input('ekspedisi'),
            'hp'        => $request->input('hp_pengirim'),
        ]);
    }

    // 4. Menampilkan Halaman Sukses (Disamakan dengan web.php Anda)
    public function sukses(Request $request, $id)
    {
        // Membuat object tiruan untuk dikirim ke view agar sesuai dengan variabel di barang-sukses.blade.php
        $pengiriman = (object) [
            'id'              => $id,
            'nama_pengirim'   => $request->query('nama'),
            'program'         => $request->query('program'),
            'ekspedisi'       => $request->query('ekspedisi'),
            'hp_pengirim'     => $request->query('hp'),
        ];

        // PERBAIKAN: Mengarahkan ke view di dalam folder barang (barang/barang-sukses.blade.php)
        return view('barang.barang-sukses', compact('pengiriman'));
    }
}