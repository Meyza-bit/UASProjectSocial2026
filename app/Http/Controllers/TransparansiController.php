<?php

namespace App\Http\Controllers;

use App\Models\ProgramDonasi;
use App\Models\DonasiDana;
use App\Models\DonasiBarang;
use App\Models\Feedback;
use Illuminate\Http\Request;

class TransparansiController extends Controller
{
    public function index()
    {
        $donasiDana = DonasiDana::with(['user', 'program'])
            ->where('status', 'verified')
            ->latest()
            ->get();

        $donasiBarang = DonasiBarang::with(['user', 'targetPenerima', 'items'])
            ->where('status', 'diterima')
            ->latest()
            ->get();

        $totalDana = $donasiDana->sum('nominal');
        $totalDonatur = $donasiDana->count() + $donasiBarang->count();

        return view('transparansi.index', compact(
            'donasiDana',
            'donasiBarang',
            'totalDana',
            'totalDonatur'
        ));
    }
}