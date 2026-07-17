<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiDana extends Model
{
    use HasFactory;

    protected $table = 'donasi_dana';

    protected $fillable = [
        'id_user',
        'id_program',
        'id_target',
        'nominal',
        'metode_bayar',
        'pesan',
        'anonim',
        'status',
        'bukti_pembayaran'
    ];

    protected $casts = [
        'nominal' => 'integer',
        'anonim' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function program()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_program');
    }

    public function targetPenerima()
    {
        return $this->belongsTo(TargetPenerima::class, 'id_target', 'id_target');
    }
}
