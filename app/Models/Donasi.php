<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    // Menghubungkan model ke tabel 'donasis' (opsional jika nama tabel sesuai konvensi)
    protected $table = 'donasi';

    // Ini bagian terpenting: Mendefinisikan kolom mana saja yang boleh diisi
    // Tanpa ini, data dari form donasi tidak akan bisa tersimpan
    protected $fillable = [
        'name', 
        'amount', 
        'message', 
        'metode_pembayaran', 
        'bukti_pembayaran',
        'status'
    ];
}