<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    // GET /api/feedback
    public function index(Request $request)
    {
        $query = Feedback::query();

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $feedbacks = $query->where('verified', true)->latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $feedbacks,
            'total'  => $feedbacks->count(),
        ], 200);
    }

    // POST /api/feedback
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'nullable|string|max:255',
            'anonim'   => 'required|boolean',
            'peran'    => 'required|in:donatur,penerima,relawan,umum',
            'rating'   => 'required|integer|min:1|max:5',
            'kategori' => 'required|in:transparansi,barang,layanan,website,lainnya',
            'isi'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $feedback = Feedback::create([
            'nama'     => $request->anonim ? null : $request->nama,
            'anonim'   => $request->anonim,
            'peran'    => $request->peran,
            'rating'   => $request->rating,
            'kategori' => $request->kategori,
            'isi'      => $request->isi,
            'verified' => false,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Ulasan berhasil dikirim',
            'data'    => $feedback,
        ], 201);
    }
}