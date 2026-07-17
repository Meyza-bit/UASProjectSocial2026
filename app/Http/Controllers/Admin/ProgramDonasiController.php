<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramDonasi;
use App\Models\TargetPenerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramDonasiController extends Controller
{
    public function index()
    {
        $programs = ProgramDonasi::latest()->paginate(20);
        return view('admin.program-donasi.index', compact('programs'));
    }

    public function create()
    {
        $targets = TargetPenerima::all();
        return view('admin.program-donasi.create', compact('targets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_target'       => 'nullable|exists:target_penerima,id_target',
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'kategori'        => 'required|in:Banjir,Gempa,Erupsi,Kebakaran,Lainnya',
            'target_dana'     => 'required|integer|min:1000',
            'dana_terkumpul'  => 'nullable|integer|min:0',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status'          => 'required|in:aktif,darurat,selesai',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('program_gambar', 'public');
        }

        ProgramDonasi::create([
            'id_target'       => $request->id_target ?: null,
            'judul'           => $request->judul,
            'deskripsi'       => $request->deskripsi,
            'kategori'        => $request->kategori,
            'target_dana'     => $request->target_dana,
            'dana_terkumpul'  => $request->dana_terkumpul ?? 0,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => $request->status,
            'gambar'          => $path,
        ]);

        return redirect()->route('admin.program-donasi.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(ProgramDonasi $program_donasi)
    {
        $targets = TargetPenerima::all();
        return view('admin.program-donasi.edit', [
            'program' => $program_donasi,
            'targets' => $targets,
        ]);
    }

    public function update(Request $request, ProgramDonasi $program_donasi)
    {
        $request->validate([
            'id_target'       => 'nullable|exists:target_penerima,id_target',
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'kategori'        => 'required|in:Banjir,Gempa,Erupsi,Kebakaran,Lainnya',
            'target_dana'     => 'required|integer|min:1000',
            'dana_terkumpul'  => 'nullable|integer|min:0',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status'          => 'required|in:aktif,darurat,selesai',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'id_target', 'judul', 'deskripsi', 'kategori',
            'target_dana', 'dana_terkumpul', 'tanggal_mulai',
            'tanggal_selesai', 'status',
        ]);

        $data['id_target'] = $request->id_target ?: null;

        if ($request->hasFile('gambar')) {
            if ($program_donasi->gambar && !str_starts_with($program_donasi->gambar, 'http')) {
                Storage::disk('public')->delete($program_donasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('program_gambar', 'public');
        }

        $program_donasi->update($data);

        return redirect()->route('admin.program-donasi.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(ProgramDonasi $program_donasi)
    {
        if ($program_donasi->gambar && !str_starts_with($program_donasi->gambar, 'http')) {
            Storage::disk('public')->delete($program_donasi->gambar);
        }

        $program_donasi->delete();

        return back()->with('success', 'Program berhasil dihapus.');
    }
}