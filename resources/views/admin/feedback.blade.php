@extends('layouts.admin')
@section('title', 'Moderasi Umpan Balik')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-xs">
    <div class="p-5 border-b border-slate-100">
        <h3 class="font-bold text-slate-800">💬 Pengawasan Umpan Balik Publik (Anti Spam)</h3>
    </div>
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
            <tr>
                <th class="p-4 pl-6">Pengirim</th>
                <th class="p-4">Isi Komentar / Umpan Balik</th>
                <th class="p-4 text-center pr-6">Aksi Bersihkan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
            @forelse($feedbacks as $fb)
            <tr>
                <td class="p-4 pl-6 font-bold text-slate-900">{{ $fb->nama ?? 'Anonim' }}</td>
                <td class="p-4 text-slate-500 max-w-sm whitespace-normal">{{ $fb->komentar }}</td>
                <td class="p-4 text-center pr-6">
                    <form action="/admin/feedback/{{ $fb->id }}/hapus" method="POST" onsubmit="return confirm('Hapus komentar negatif/spam ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-rose-50 text-rose-700 border border-rose-200 font-bold px-3 py-1.5 rounded-lg hover:bg-rose-100 transition shadow-sm">🗑️ Hapus Komentar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-8 text-center text-slate-400">Kolom umpan balik bersih, tidak ada komentar terdeteksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">
        {{ $feedbacks->links() }}
    </div>
</div>
@endsection