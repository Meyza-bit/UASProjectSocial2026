@extends('layouts.app')

@section('title', 'Pilih Pembayaran - MariBerbagi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-emerald-950">Pilih Metode Pembayaran</h1>
        <p class="text-slate-600 mt-2">Selesaikan donasi Anda dengan memilih metode yang paling nyaman.</p>
    </div>

    {{-- FORM UTAMA --}}
    <form action="{{ route('donasi.konfirmasi') }}" method="POST" id="form-pembayaran">
        @csrf
        <input type="hidden" name="metode" id="input-metode" value="">

        <div class="space-y-6">
           {{-- Section E-Wallet --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm flex flex-col md:flex-row">
                    <div class="bg-emerald-600 p-6 md:w-1/4 flex flex-col items-center justify-center text-center text-white">
                <span class="text-3xl mb-2">📱</span>
                <h3 class="font-bold">E-Wallet</h3>
             </div>
             <div class="p-6 grid grid-cols-2 md:grid-cols-3 gap-4 w-full">
                    <div class="border rounded-xl p-3 cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('GoPay', this)">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="GoPay" class="h-8 object-contain mx-auto">
                    </div>
                    <div class="border rounded-xl p-3 cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('DANA', this)">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="DANA" class="h-8 object-contain mx-auto">
                    </div>
                    <div class="border rounded-xl p-3 cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('OVO', this)">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO" class="h-8 object-contain mx-auto">
                    </div>
                </div>
            </div>
            

        {{-- Section 2: Transfer Bank --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm flex flex-col md:flex-row">
            <div class="bg-emerald-600 p-6 md:w-1/4 flex flex-col items-center justify-center text-center text-white">
                <span class="text-3xl mb-2">🏦</span>
                <h3 class="font-bold">Transfer Bank</h3>
             </div>
                <div class="p-6 grid grid-cols-2 md:grid-cols-3 gap-4 w-full">
        
                {{-- BCA --}}
                <div class="border border-slate-200 rounded-xl p-3 flex items-center justify-center cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('BCA', this)">
                    <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Central_Asia.svg" alt="BCA" class="h-8 object-contain mx-auto"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-fallback hidden items-center justify-center text-xs font-bold text-white bg-[#0066AE] px-2 py-1 rounded w-full h-8">BCA</span>
                </div>

                {{-- Mandiri --}}
                <div class="border border-slate-200 rounded-xl p-3 flex items-center justify-center cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('Mandiri', this)">
                    <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Mandiri_logo_2016.svg" alt="Mandiri" class="h-8 object-contain mx-auto"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-fallback hidden items-center justify-center text-xs font-bold text-white bg-[#003D79] px-2 py-1 rounded w-full h-8">Mandiri</span>
                </div>

                {{-- BRI --}}
                <div class="border border-slate-200 rounded-xl p-3 flex items-center justify-center cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('BRI', this)">
                    <img src="https://commons.wikimedia.org/wiki/Special:FilePath/BANK_BRI_logo.svg" alt="BRI" class="h-8 object-contain mx-auto"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-fallback hidden items-center justify-center text-xs font-bold text-white bg-[#00529C] px-2 py-1 rounded w-full h-8">BRI</span>
                </div>

                {{-- BNI --}}
                <div class="border border-slate-200 rounded-xl p-3 flex items-center justify-center cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('BNI', this)">
                    <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Negara_Indonesia_logo_(2004).svg" alt="BNI" class="h-8 object-contain mx-auto"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-fallback hidden items-center justify-center text-xs font-bold text-white bg-[#F36F21] px-2 py-1 rounded w-full h-8">BNI</span>
                </div>

                {{-- BSI --}}
                <div class="border border-slate-200 rounded-xl p-3 flex items-center justify-center cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('BSI', this)">
                    <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Bank_Syariah_Indonesia.svg" alt="BSI" class="h-8 object-contain mx-auto"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-fallback hidden items-center justify-center text-xs font-bold text-white bg-[#199A4D] px-2 py-1 rounded w-full h-8">BSI</span>
                </div>

                {{-- CIMB Niaga --}}
                <div class="border border-slate-200 rounded-xl p-3 flex items-center justify-center cursor-pointer hover:border-emerald-600 transition" onclick="pilihMetode('CIMB Niaga', this)">
                    <img src="https://commons.wikimedia.org/wiki/Special:FilePath/CIMB_Niaga_logo.svg" alt="CIMB Niaga" class="h-8 object-contain mx-auto"
                        onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="logo-fallback hidden items-center justify-center text-xs font-bold text-white bg-[#7E1A1A] px-2 py-1 rounded w-full h-8">CIMB Niaga</span>
                </div>

            </div>
        </div>

        <div class="mt-10 flex justify-center gap-4">
            <button type="submit" class="bg-emerald-800 hover:bg-emerald-900 text-white px-12 py-4 rounded-xl font-bold transition shadow-lg">
                Konfirmasi Pembayaran
            </button>
        </div>
    </form>
</div>

<script>
    function pilihMetode(nama, element) {
        // Simpan nama ke input hidden
        document.getElementById('input-metode').value = nama;
        
        // Reset semua ring
        document.querySelectorAll('.cursor-pointer').forEach(el => 
            el.classList.remove('ring-2', 'ring-emerald-600', 'border-emerald-600')
        );
        
        // Tambahkan ring ke yang dipilih
        element.classList.add('ring-2', 'ring-emerald-600', 'border-emerald-600');
    }

    // Validasi sebelum submit
    document.getElementById('form-pembayaran').onsubmit = function() {
        if (document.getElementById('input-metode').value === "") {
            alert("Silakan pilih metode pembayaran terlebih dahulu.");
            return false;
        }
    };
</script>
@endsection