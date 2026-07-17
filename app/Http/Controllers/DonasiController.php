<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonasiDana;
use App\Models\ProgramDonasi;

class DonasiController extends Controller
{
    private $infoPembayaran = [
        'gopay'            => ['tipe' => 'ewallet', 'tujuan' => '0812-3456-7890', 'label' => 'Nomor GoPay'],
        'dana'             => ['tipe' => 'ewallet', 'tujuan' => '0812-3456-7890', 'label' => 'Nomor DANA'],
        'ovo'              => ['tipe' => 'ewallet', 'tujuan' => '0812-3456-7890', 'label' => 'Nomor OVO'],
        'transfer_bca'     => ['tipe' => 'bank', 'tujuan' => '8801 1234 5678', 'label' => 'No. Rekening BCA'],
        'transfer_mandiri' => ['tipe' => 'bank', 'tujuan' => '113 0099 8877', 'label' => 'No. Rekening Mandiri'],
        'qris'             => ['tipe' => 'ewallet', 'tujuan' => 'Scan QRIS', 'label' => 'QRIS'],
    ];

    public function create($program = null)
    {
        if ($program) {
            session(['program_id' => $program]);
        }

        $programInfo = $program ? ProgramDonasi::find($program) : null;

        return view('donasi.create', ['program' => $programInfo]);
    }

    public function pembayaran()
    {
        if (!session('donasi_id')) {
            return redirect()->route('donasi.create')
                ->with('error', 'Silakan isi data donasi terlebih dahulu.');
        }

        return view('donasi.pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'  => 'required|numeric|min:1000',
            'message' => 'nullable|string',
        ]);

        $donasi = DonasiDana::create([
            'id_user'    => auth()->id(),
            'id_program' => session('program_id'),
            'nominal'    => $request->amount,
            'pesan'      => $request->message ?? '-',
            'status'     => 'pending',
            'metode_bayar' => 'transfer_bca',
        ]);

        session(['donasi_id' => $donasi->id]);

        return redirect()->route('donasi.pembayaran');
    }

    public function konfirmasi(Request $request)
    {
        $request->validate(['metode' => 'required']);

        $id = session('donasi_id');
        $donasi = DonasiDana::find($id);

        if ($donasi) {
            $mapMetode = [
                'GoPay'      => 'gopay',
                'DANA'       => 'dana',
                'OVO'        => 'ovo',
                'BCA'        => 'transfer_bca',
                'Mandiri'    => 'transfer_mandiri',
            ];

            $metode = $mapMetode[$request->metode] ?? 'transfer_bca';

            $donasi->update(['metode_bayar' => $metode]);
            return redirect()->route('donasi.instruksi');
        }

        return redirect()->route('donasi.create')->with('error', 'Sesi habis, silakan mulai ulang.');
    }

    public function instruksi()
    {
        $id = session('donasi_id');
        $donasi = DonasiDana::find($id);

        if (!$donasi || !$donasi->metode_bayar) {
            return redirect()->route('donasi.create');
        }

        $info = $this->infoPembayaran[$donasi->metode_bayar] ?? [
            'tipe' => 'bank', 'tujuan' => '-', 'label' => 'Tujuan Pembayaran',
        ];

        return view('donasi.pembayaran_instruksi', [
            'donasi' => $donasi,
            'info'   => $info,
        ]);
    }

    public function selesai(Request $request)
    {
        $id = session('donasi_id');
        $donasi = DonasiDana::find($id);

        if (!$donasi) {
            return redirect()->route('donasi.create')->with('error', 'Sesi habis, silakan mulai ulang.');
        }

        $request->validate([
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'bukti.required' => 'Mohon upload bukti transfer terlebih dahulu.',
            'bukti.mimes'    => 'File harus berformat JPG, PNG, atau PDF.',
            'bukti.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');

        $donasi->update([
            'bukti_pembayaran' => $path,
            'status'           => 'pending',
        ]);

        session()->forget('donasi_id');

        return redirect()->route('donasi.terimakasih', $donasi->id);
    }

    public function terimakasih($id)
    {
        $donasi = DonasiDana::findOrFail($id);
        return view('donasi.donasi_terimakasih', ['donasi' => $donasi]);
    }
}