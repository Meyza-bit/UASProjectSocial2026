<?php

namespace App\Http\Controllers;

use App\Models\ProgramDonasi;
use App\Models\DonasiDana;
use App\Models\DonasiBarang;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransparansiController extends Controller
{
    /**
     * GET /api/transparansi
     * Ringkasan total transparansi semua program
     */
    public function index(): JsonResponse
    {
        $programs = ProgramDonasi::withCount([
            'donasiDanas',
            'donasiBarangs',
            'feedbacks',
        ])->withSum('donasiDanas', 'nominal')->get();

        $ringkasan = [
            'total_program'       => $programs->count(),
            'total_donasi_dana'   => $programs->sum('donasi_danas_sum_nominal'),
            'total_donasi_barang' => $programs->sum('donasi_barangs_count'),
            'total_feedback'      => $programs->sum('feedbacks_count'),
            'programs'            => $programs,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Data transparansi berhasil diambil',
            'data'    => $ringkasan,
        ], 200);
    }

    /**
     * GET /api/transparansi/{program_id}
     * Detail transparansi satu program
     */
    public function show(string $programId): JsonResponse
    {
        $program = ProgramDonasi::find($programId);

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan',
            ], 404);
        }

        // Donasi dana untuk program ini
        $donasiDana = DonasiDana::where('id_program', $programId)
            ->select('id', 'id_user', 'id_program', 'nominal', 'metode_bayar', 'status', 'created_at')
            ->with('user:id,name')
            ->latest()
            ->get();

        // Donasi barang untuk program ini
        $donasiBarang = DonasiBarang::where('program_donasi_id', $programId)
            ->select('id', 'user_id', 'nama_pengirim', 'status', 'created_at')
            ->with(['user:id,name', 'itemBarangs'])
            ->latest()
            ->get();

        // Feedback untuk program ini
        $feedbacks = Feedback::where('program_donasi_id', $programId)
            ->select('id', 'user_id', 'judul', 'isi', 'rating', 'created_at')
            ->with('user:id,name')
            ->latest()
            ->get();

        $data = [
            'program'             => $program,
            'total_dana_masuk'    => $donasiDana->where('status', 'verified')->sum('nominal'),
            'total_donatur_dana'  => $donasiDana->count(),
            'total_donatur_barang'=> $donasiBarang->count(),
            'rata_rata_rating'    => round($feedbacks->avg('rating'), 1),
            'donasi_dana'         => $donasiDana,
            'donasi_barang'       => $donasiBarang,
            'feedbacks'           => $feedbacks,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Detail transparansi program berhasil diambil',
            'data'    => $data,
        ], 200);
    }
}
