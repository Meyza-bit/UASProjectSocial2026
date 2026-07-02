<?php

namespace App\Http\Controllers;

use App\Models\ProgramDonasi;

class HomeController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::aktif()->latest()->take(3)->get();
        
        return view('home', compact('programs'));
    }
}