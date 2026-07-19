<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonasiBarang;
use App\Models\ItemBarang;
use App\Models\ProgramDonasi;

class BarangController extends Controller
{
    // 1. Menampilkan Katalog Barang
    public function index()
    {
        return view('barang.index');
    }

    // 2. Menampilkan Form Donasi Barang
    public function create($program = null)
    {
        $programs = ProgramDonasi::all();
        $selectedProgram = $program ? ProgramDonasi::find($program) : null;

        return view('barang.create', compact('programs', 'selectedProgram'));
    }

    // 3. Menyimpan Data dari Form
    public function store(Request $request)
    {
        $request->validate([
            'program_donasi_id' => 'required|exists:program_donasi,id',
            'kategori'          => 'required',
            'nama_pengirim'     => 'required|string|max:255',
            'hp_pengirim'       => 'required|string|max:20',
            'alamat_pengirim'   => 'required|string',
            'barang'            => 'required|array|min:1',
            'barang.*.nama'     => 'required|string|max:255',
            'barang.*.jumlah'   => 'required|numeric|min:1',
            'barang.*.satuan'   => 'required|string',
        ]);

        // Simpan data pengiriman (tabel donasi_barang)
        $donasiBarang = DonasiBarang::create([
            'program_donasi_id' => $request->program_donasi_id,
            'user_id'           => auth()->id(),
            'nama_pengirim'     => $request->nama_pengirim,
            'alamat_pengirim'   => $request->alamat_pengirim,
            'nomor_telepon'     => $request->hp_pengirim,
            'status'            => 'pending',
            'catatan'           => 'Ekspedisi: ' . $request->ekspedisi,
        ]);

        // Simpan setiap barang ke tabel item_barangs
        foreach ($request->barang as $item) {
            // Pastikan kondisi berformat lowercase dan snake_case agar lolos CHECK constraint
            $kondisi = isset($item['kondisi']) ? strtolower(str_replace(' ', '_', $item['kondisi'])) : 'layak_pakai';

            ItemBarang::create([
                'donasi_barang_id' => $donasiBarang->id,
                'nama_barang'      => $item['nama'],
                'kategori'         => $request->kategori,
                'jumlah'           => $item['jumlah'],
                'satuan'           => $item['satuan'],
                'kondisi'          => $kondisi,
                'deskripsi'        => null,
            ]);
        }

        return redirect()->route('barang.sukses', $donasiBarang->id);
    }

    // 4. Menampilkan Halaman Sukses
    public function sukses($id)
    {
        $pengiriman = DonasiBarang::with(['programDonasi', 'itemBarang'])->findOrFail($id);
        return view('barang.barang-sukses', compact('pengiriman'));
    }
}