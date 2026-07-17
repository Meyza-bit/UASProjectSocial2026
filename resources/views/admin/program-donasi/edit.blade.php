@extends('layouts.admin')
@section('title', 'Edit Program Donasi')

@section('admin-content')
<div class="max-w-2xl">
    <h2 class="text-xl font-bold text-slate-900 mb-6">✎ Edit Program Donasi</h2>

    <form action="{{ route('admin.program-donasi.update', $program->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
        @csrf
        @method('PUT')

        @if($program->gambar)
        <div>
            <p class="text-xs font-semibold text-slate-500 mb-2">Gambar saat ini:</p>
            <img src="{{ str_starts_with($program->gambar, 'http') ? $program->gambar : asset('storage/'.$program->gambar) }}" class="w-32 h-32 object-cover rounded-xl border border-slate-200">
        </div>
        @endif

        @include('admin.program-donasi._form')

        <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-bold py-3 rounded-xl transition">
            Update Program
        </button>
    </form>
</div>
@endsection