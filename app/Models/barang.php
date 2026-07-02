<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'program',
        'prioritas',
        'kategori',
        'daftar_barang',
        'nama_pengirim',
        'hp_pengirim',
        'alamat_pengirim',
        'ekspedisi',
        'berat',
        'status',
    ];

    protected $casts = [
        // 'daftar_barang' otomatis berubah dari/ke array PHP <-> JSON di database
        'daftar_barang' => 'array',
    ];
}