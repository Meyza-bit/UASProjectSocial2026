<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonasiDana;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    // GET /api/donasi -> Menampilkan semua data riwayat donasi yang statusnya sudah 'verified'
    public function index()
    {
        $donasi = DonasiDana::where('status', 'verified')
            ->with(['user:id,name', 'programDonasi:id,judul'])
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $donasi,
            'total'  => $donasi->count()
        ], 200);
    }

    // POST /api/donasi/dana -> Menyimpan data transaksi donasi uang baru ke database
    public function storeDana(Request $request)
    {
        // Aturan validasi input data dari user
        $validator = Validator::make($request->all(), [
            'id_program'   => 'required|exists:program_donasi,id',
            'nominal'      => 'required|numeric|min:1000',
            'metode_bayar' => 'required|string',
            'pesan'        => 'nullable|string',
            'anonim'       => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Cari program donasi terkait untuk mencocokkan id_target secara otomatis
        $program = ProgramDonasi::find($request->id_program);

        // Eksekusi penyimpanan data ke tabel donasi_dana
        $donasi = DonasiDana::create([
            'id_user'      => Auth::id(), // Diambil dari id user yang sedang login tokennya
            'id_program'   => $request->id_program,
            'id_target'    => $program->id_target, // Terisi otomatis dari relasi program
            'nominal'      => $request->nominal,
            'metode_bayar' => $request->metode_bayar,
            'pesan'        => $request->pesan,
            'anonim'       => $request->anonim,
            'status'       => 'pending' // Setiap donasi baru masuk diberi status awal pending
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Donasi berhasil dikirim!',
            'data'    => $donasi
        ], 201);
    }
}