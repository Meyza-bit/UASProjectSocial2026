<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiBarang extends Model
{
    use HasFactory;

    protected $table = 'donasi_barang';

    protected $fillable = [
        'id_user',
        'id_target',
        'kategori',
        'nama_pengirim',
        'hp_pengirim',
        'alamat_pengirim',
        'kota_pengirim',
        'provinsi_pengirim',
        'kodepos_pengirim',
        'ekspedisi',
        'berat_total',
        'catatan',
        'status',
    ];

    protected $casts = [
        'berat_total' => 'decimal:2',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke TargetPenerima
    public function targetPenerima()
    {
        return $this->belongsTo(TargetPenerima::class, 'id_target', 'id_target');
    }

    // Relasi ke ItemBarang
    public function items()
    {
        return $this->hasMany(ItemBarang::class, 'id_donasi_barang', 'id');
    }

    // Scope status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDikirim($query)
    {
        return $query->where('status', 'dikirim');
    }

    public function scopeDiterima($query)
    {
        return $query->where('status', 'diterima');
    }
}