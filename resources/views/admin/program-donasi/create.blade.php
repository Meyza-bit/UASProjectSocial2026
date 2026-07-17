@extends('layouts.admin')
@section('title', 'Tambah Program Donasi')

@section('admin-content')
<div class="max-w-2xl">
    <h2 class="text-xl font-bold text-slate-900 mb-6">➕ Tambah Program Donasi</h2>

    <form action="{{ route('admin.program-donasi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
        @csrf

        @include('admin.program-donasi._form')

        <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-bold py-3 rounded-xl transition">
            Simpan Program
        </button>
    </form>
</div>
@endsection
