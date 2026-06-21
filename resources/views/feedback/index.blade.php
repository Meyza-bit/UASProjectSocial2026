@extends('layouts.app')

@section('title', 'Feedback Donatur')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold text-emerald-800 mb-8">
        Ulasan Donatur
    </h1>

    {{-- FORM ULASAN --}}
    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Nama
                </label>

                <input
                    type="text"
                    name="nama"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Rating
                </label>

                <select
                    name="rating"
                    class="w-full border rounded-lg px-4 py-2"
                    required>
                    <option value="">Pilih Rating</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Ulasan
                </label>

                <textarea
                    name="ulasan"
                    rows="4"
                    class="w-full border rounded-lg px-4 py-2"
                    required></textarea>
            </div>

            <button
                type="submit"
                class="bg-emerald-700 text-white px-6 py-3 rounded-lg hover:bg-emerald-800">
                Kirim Ulasan
            </button>
        </form>
    </div>

    {{-- FILTER --}}
    <div class="bg-white p-4 rounded-xl shadow mb-8">
        <form method="GET">
            <div class="flex gap-3">
                <select
                    name="rating"
                    class="border rounded-lg px-4 py-2">

                    <option value="">
                        Semua Rating
                    </option>

                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>

                <button
                    class="bg-slate-800 text-white px-4 rounded-lg">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- LIST ULASAN --}}
    <div class="space-y-4">

        @forelse($feedbacks as $feedback)

            <div class="bg-white p-5 rounded-xl shadow">

                <div class="flex justify-between mb-2">

                    <h3 class="font-bold">
                        {{ $feedback->nama }}
                    </h3>

                    <span>
                        {{ str_repeat('⭐', $feedback->rating) }}
                    </span>

                </div>

                <p class="text-slate-600">
                    {{ $feedback->ulasan }}
                </p>

            </div>

        @empty

            <div class="bg-white p-6 rounded-xl text-center">
                Belum ada ulasan.
            </div>

        @endforelse

    </div>

</div>
@endsection