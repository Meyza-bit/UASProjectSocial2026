<?php

namespace App\Http\Controllers;

use App\Models\ProgramDonasi;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::aktif()->with('targetPenerima')->latest()->get();

        return view('program', compact('programs'));
    }
}
