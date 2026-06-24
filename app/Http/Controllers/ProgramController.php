<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramDonasi;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::aktif()->latest()->get();

        return view('program', compact('programs'));
    }
}