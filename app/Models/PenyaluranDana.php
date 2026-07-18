<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyaluranDana extends Model
{
    use HasFactory;

    protected $table = 'penyaluran_dana';

    protected $fillable = [
        'id_program',
        'jumlah',
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