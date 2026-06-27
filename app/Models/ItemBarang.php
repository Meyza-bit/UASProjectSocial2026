<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBarang extends Model
{
    use HasFactory;

    protected $table = 'item_barangs';

    protected $fillable = [
        'donasi_barang_id',
        'nama_barang',
        'kategori',
        'jumlah',
        'satuan',
        'kondisi',
        'deskripsi',
    ];

    protected $casts = [
        'jumlah'     => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELASI ====================

    // Belongs to DonasiBarang
    public function donasiBarang()
    {
        return $this->belongsTo(DonasiBarang::class, 'donasi_barang_id');
    }

    // ==================== SCOPE ====================

    // Filter berdasarkan kondisi
    public function scopeKondisi($query, $kondisi)
    {
        return $query->where('kondisi', $kondisi);
    }
}