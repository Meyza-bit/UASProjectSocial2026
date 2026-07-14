@extends('layouts.admin')
@section('title', 'Manajemen User')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-xs">
    <div class="p-5 border-b border-slate-100">
        <h3 class="font-bold text-slate-800">👥 Anggota & Donatur Terdaftar</h3>
    </div>
    <table class="w-full text-left border-collapse whitespace-nowrap">
        <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] border-b border-slate-200">
            <tr>
                <th class="p-4 pl-6">Nama Akun</th>
                <th class="p-4">Kontak Email</th>
                <th class="p-4">Hak Akses / Role</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
            @forelse($users as $user)
            <tr>
                <td class="p-4 pl-6 font-bold text-slate-900">{{ $user->name }}</td>
                <td class="p-4 font-mono text-slate-500">{{ $user->email }}</td>
                <td class="p-4">
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-slate-50 text-slate-600 border border-slate-200' }}">
                        {{ strtoupper($user->role) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-8 text-center text-slate-400">Tidak ada user terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-slate-100">
        {{ $users->links() }}
    </div>
</div>
@endsection