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

        $feedbacks = $query->latest()->get();

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
            'nama'   => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $feedback = Feedback::create($validator->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Ulasan berhasil dikirim',
            'data'    => $feedback,
        ], 201);
    }
}