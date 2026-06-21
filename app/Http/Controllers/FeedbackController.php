<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::query();

        if ($request->rating) {
            $query->where('rating', $request->rating);
        }

        $feedbacks = $query->latest()->get();

        return view('feedback.index', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required'
        ]);

        Feedback::create($request->all());

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim');
    }
}