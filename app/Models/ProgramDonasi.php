<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDonasi extends Model
{
    use HasFactory;

    protected $table = 'program_donasi';

    protected $fillable = [
        'id_target',
        'judul',
        'deskripsi',
        'kategori',
        'target_dana',
        'dana_terkumpul',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'gambar',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'target_dana'     => 'integer',
        'dana_terkumpul'  => 'integer',
    ];

    // Relasi ke TargetPenerima
    public function targetPenerima()
    {
        return $this->belongsTo(TargetPenerima::class, 'id_target', 'id_target');
    }

    // Relasi ke DonasiDana
    public function donasiDana()
    {
        return $this->hasMany(DonasiDana::class, 'id_program', 'id');
    }

    // Relasi ke Feedback
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id_program', 'id');
    }

    // Hitung persentase donasi
    public function getPresentaseAttribute()
    {
        if ($this->target_dana == 0) return 0;
        return round(($this->dana_terkumpul / $this->target_dana) * 100);
    }

    // Hitung sisa hari
    public function getSisaHariAttribute()
    {
        return now()->diffInDays($this->tanggal_selesai, false);
    }

    // Scope untuk program aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk program darurat
    public function scopeDarurat($query)
    {
        return $query->where('status', 'darurat');
    }
}