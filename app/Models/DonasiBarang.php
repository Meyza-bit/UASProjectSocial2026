<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiBarang extends Model
{
    use HasFactory;

    protected $table = 'donasi_barangs';

    protected $fillable = [
        'program_donasi_id',
        'user_id',
        'nama_pengirim',
        'alamat_pengirim',
        'nomor_telepon',
        'status',
        'catatan',
        'tampil_publik',
    ];

    protected $casts = [
        'tampil_publik' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELASI ====================

    // Belongs to ProgramDonasi
    public function programDonasi()
    {
        return $this->belongsTo(ProgramDonasi::class, 'program_donasi_id');
    }

    // Belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Has many ItemBarang
    public function itemBarang()
    {
        return $this->hasMany(ItemBarang::class, 'donasi_barang_id');
    }

    // Filter berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Filter pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Filter diterima
    public function scopeDiterima($query)
    {
        return $query->where('status', 'diterima');
    }

    // Filter yang boleh ditampilkan ke publik
    public function scopeTampilPublik($query)
    {
        return $query->where('tampil_publik', true);
    }
}