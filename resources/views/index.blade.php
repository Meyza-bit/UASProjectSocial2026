{{-- resources/views/feedback/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Feedback Donatur')

@section('content')
<div class="container py-4">

    {{-- Header & Rata-rata Rating --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Feedback Donatur</h2>
            <small class="text-muted">
                Rata-rata rating: <strong>{{ number_format($rataRating, 1) }} / 5</strong>
            </small>
        </div>
        <a href="{{ route('feedback.terbaik') }}" class="btn btn-outline-warning btn-sm">
            ★ Tampilkan Rating Tinggi
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form Kirim Feedback --}}
    @auth
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-semibold">Tulis Feedback</div>
        <div class="card-body">
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Program Donasi</label>
                    <select name="id_program" class="form-select @error('id_program') is-invalid @enderror" required>
                        <option value="">-- Pilih Program --</option>
                        {{-- Diisi dari controller jika diperlukan --}}
                    </select>
                    @error('id_program')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                        @foreach([5,4,3,2,1] as $r)
                            <option value="{{ $r }}">{{ str_repeat('★', $r) . str_repeat('☆', 5-$r) }} ({{ $r }})</option>
                        @endforeach
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Komentar</label>
                    <textarea name="isi" rows="3"
                        class="form-control @error('isi') is-invalid @enderror"
                        placeholder="Ceritakan pengalaman Anda..." required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Kirim Feedback</button>
            </form>
        </div>
    </div>
    @endauth

    {{-- Daftar Feedback --}}
    @forelse($feedbacks as $fb)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="fw-semibold">{{ $fb->user?->name ?? 'Anonim' }}</span>
                    <span class="text-muted ms-2" style="font-size:.85rem;">
                        · {{ $fb->program?->nama ?? '-' }}
                    </span>
                </div>
                {{-- Accessor getBintangAttribute --}}
                <span class="text-warning fs-5">{{ $fb->bintang }}</span>
            </div>
            <p class="mt-2 mb-1">{{ $fb->isi }}</p>
            <small class="text-muted">{{ $fb->created_at->diffForHumans() }}</small>
        </div>
    </div>
    @empty
        <div class="text-center text-muted py-5">Belum ada feedback.</div>
    @endforelse

</div>
@endsection