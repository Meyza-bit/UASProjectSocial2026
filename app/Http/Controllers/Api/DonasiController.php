<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonasiDana;
use App\Models\DonasiBarang;
use App\Models\ItemBarang;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    // GET /api/donasi — list semua donasi verified
    public function index()
    {
        $donasi = DonasiDana::where('status', 'verified')
            ->with(['user:id,name', 'program:id,judul'])
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $donasi,
            'total'  => $donasi->count(),
        ]);
    }

    // POST /api/donasi/dana — simpan donasi dana
    public function storeDana(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_program'   => 'required|exists:program_donasi,id',
            'nominal'      => 'required|numeric|min:1000',
            'metode_bayar' => 'required|string',
            'pesan'        => 'nullable|string',
            'anonim'       => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $program = ProgramDonasi::find($request->id_program);

        $donasi = DonasiDana::create([
            'id_user'      => Auth::id(),
            'id_program'   => $request->id_program,
            'id_target'    => $program->id_target,
            'nominal'      => $request->nominal,
            'metode_bayar' => $request->metode_bayar,
            'pesan'        => $request->pesan,
            'anonim'       => $request->anonim,
            'status'       => 'pending',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Donasi berhasil dikirim!',
            'data'    => $donasi,
        ], 201);
    }

    // POST /api/donasi/barang — simpan donasi barang
    public function storeBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_target'       => 'required|exists:target_penerima,id_target',
            'kategori'        => 'required|string',
            'nama_pengirim'   => 'required|string',
            'hp_pengirim'     => 'required|string',
            'alamat_pengirim' => 'required|string',
            'ekspedisi'       => 'required|string',
            'items'           => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah'      => 'required|integer|min:1',
            'items.*.satuan'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $donasiBarang = DonasiBarang::create([
            'id_user'           => Auth::id(),
            'id_target'         => $request->id_target,
            'kategori'          => $request->kategori,
            'nama_pengirim'     => $request->nama_pengirim,
            'hp_pengirim'       => $request->hp_pengirim,
            'alamat_pengirim'   => $request->alamat_pengirim,
            'kota_pengirim'     => $request->kota_pengirim,
            'provinsi_pengirim' => $request->provinsi_pengirim,
            'ekspedisi'         => $request->ekspedisi,
            'berat_total'       => $request->berat_total,
            'catatan'           => $request->catatan,
            'status'            => 'pending',
        ]);

        foreach ($request->items as $item) {
            ItemBarang::create([
                'id_donasi_barang' => $donasiBarang->id,
                'nama_barang'      => $item['nama_barang'],
                'jumlah'           => $item['jumlah'],
                'satuan'           => $item['satuan'],
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Data barang berhasil dikirim! Tim kami akan menghubungimu.',
            'data'    => $donasiBarang->load('items'),
        ], 201);
    }
}