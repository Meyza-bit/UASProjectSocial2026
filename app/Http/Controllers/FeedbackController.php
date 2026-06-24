<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    /**
     * GET /api/feedbacks
     * Ambil semua feedback (bisa filter by program)
     */
    public function index(Request $request): JsonResponse
    {
        $query = Feedback::with(['user:id,name,email', 'programDonasi:id,judul']);

        // Filter opsional berdasarkan program_donasi_id
        if ($request->has('program_id')) {
            $query->byProgram($request->program_id);
        }

        // Filter opsional berdasarkan rating minimum
        if ($request->has('min_rating')) {
            $query->minRating($request->min_rating);
        }

        $feedbacks = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Data feedback berhasil diambil',
            'data'    => $feedbacks,
        ], 200);
    }

    /**
     * POST /api/feedbacks
     * Buat feedback baru
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'program_donasi_id' => 'nullable|exists:program_donasi,id',
                'judul'             => 'required|string|max:255',
                'isi'               => 'required|string',
                'rating'            => 'required|integer|min:1|max:5',
            ]);

            // user_id dari auth (Sanctum)
            $validated['user_id'] = Auth::id();

            $feedback = Feedback::create($validated);
            $feedback->load(['user:id,name,email', 'programDonasi:id,judul']);

            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil dikirim',
                'data'    => $feedback,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 422);
        }
    }

    /**
     * GET /api/feedbacks/{id}
     * Ambil detail feedback
     */
    public function show(string $id): JsonResponse
    {
        $feedback = Feedback::with(['user:id,name,email', 'programDonasi:id,judul'])->find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail feedback berhasil diambil',
            'data'    => $feedback,
        ], 200);
    }

    /**
     * PUT /api/feedbacks/{id}
     * Update feedback (hanya pemilik)
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan',
            ], 404);
        }

        // Cek apakah yang update adalah pemilik feedback
        if ($feedback->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan mengubah feedback orang lain',
            ], 403);
        }

        try {
            $validated = $request->validate([
                'judul'  => 'sometimes|string|max:255',
                'isi'    => 'sometimes|string',
                'rating' => 'sometimes|integer|min:1|max:5',
            ]);

            $feedback->update($validated);
            $feedback->load(['user:id,name,email', 'programDonasi:id,judul']);

            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil diupdate',
                'data'    => $feedback,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 422);
        }
    }

    /**
     * DELETE /api/feedbacks/{id}
     * Hapus feedback (hanya pemilik)
     */
    public function destroy(string $id): JsonResponse
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan',
            ], 404);
        }

        if ($feedback->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan menghapus feedback orang lain',
            ], 403);
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback berhasil dihapus',
        ], 200);
    }
}