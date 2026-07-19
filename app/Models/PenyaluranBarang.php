<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyaluranBarang extends Model
{
    use HasFactory;

    protected $table = 'penyaluran_barang';

    protected $fillable = [
        'id_program',
        'nama_barang',
        'jumlah',
        'satuan',
        'penerima',
        'keterangan',
        'bukti_penyaluran',
        'tanggal_penyaluran',
    ];

    protected $casts = [
        'jumlah'             => 'integer',
        'tanggal_penyaluran' => 'date',
    ];

    public function program()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_program');
    }
}