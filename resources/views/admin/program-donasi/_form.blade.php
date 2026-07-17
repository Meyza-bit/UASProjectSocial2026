@php $p = $program ?? null; @endphp

<div>
    <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Program</label>
    <input type="text" name="judul" value="{{ old('judul', $p->judul ?? '') }}" required
        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
    @error('judul') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
    <textarea name="deskripsi" rows="4" required
        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">{{ old('deskripsi', $p->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
        <input type="text" name="kategori" value="{{ old('kategori', $p->kategori ?? '') }}" placeholder="Bencana Alam / Panti Sosial" required
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
        @error('kategori') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
        <select name="status" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
            @foreach(['aktif' => 'Aktif', 'darurat' => 'Darurat', 'selesai' => 'Selesai'] as $val => $label)
                <option value="{{ $val }}" {{ old('status', $p->status ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Target Dana (Rp)</label>
        <input type="number" name="target_dana" value="{{ old('target_dana', $p->target_dana ?? '') }}" required
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
        @error('target_dana') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Dana Terkumpul (Rp)</label>
        <input type="number" name="dana_terkumpul" value="{{ old('dana_terkumpul', $p->dana_terkumpul ?? 0) }}"
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
        @error('dana_terkumpul') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', isset($p->tanggal_mulai) ? $p->tanggal_mulai->format('Y-m-d') : '') }}" required
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
        @error('tanggal_mulai') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', isset($p->tanggal_selesai) ? $p->tanggal_selesai->format('Y-m-d') : '') }}" required
            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
        @error('tanggal_selesai') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-semibold text-slate-700 mb-2">Target Penerima (opsional)</label>
    <select name="id_target" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
        <option value="">-- Tidak ada --</option>
        @foreach($targets as $t)
            <option value="{{ $t->id_target }}" {{ old('id_target', $p->id_target ?? '') == $t->id_target ? 'selected' : '' }}>
                {{ $t->nama_target }}
            </option>
        @endforeach
    </select>
    @error('id_target') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Gambar Program</label>
    <input type="file" name="gambar" accept=".jpg,.jpeg,.png"
        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 outline-none">
    <p class="text-xs text-slate-500 mt-1">Format JPG/PNG, maksimal 2MB. {{ isset($p) ? 'Kosongkan jika tidak ingin mengubah gambar.' : '' }}</p>
    @error('gambar') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
</div>