<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramDonasi;
use App\Models\TargetPenerima; // Ditambahkan jika model ini sudah dibuat oleh rekan tim Anda
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    // GET /api/program -> Menampilkan semua program yang statusnya aktif
    public function index()
    {
        $program = ProgramDonasi::where('status', 'aktif')->with('targetPenerima')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $program,
            'total'  => $program->count()
        ], 200);
    }

    // GET /api/program/{id} -> Menampilkan detail satu program berdasarkan ID-nya
    public function show($id)
    {
        $program = ProgramDonasi::with('targetPenerima')->find($id);

        if (!$program) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Program tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $program
        ], 200);
    }

    // GET /api/program/kategori/{kategori} -> Memfilter program berdasarkan kategori tertentu
    public function filterKategori($kategori)
    {
        $program = ProgramDonasi::where('kategori', $kategori)
            ->where('status', 'aktif')
            ->with('targetPenerima')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $program,
            'total'  => $program->count()
        ], 200);
    }

    // GET /api/target-penerima -> Menampilkan list target penerima yang aktif
    public function targetPenerima()
    {
        // Fitur pendukung untuk menampilkan data target penerima
        $target = TargetPenerima::where('status_aktif', 1)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $target,
            'total'  => $target->count()
        ], 200);
    }
}