<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'program_donasi_id',
        'judul',
        'nama',
        'anonim',
        'peran',
        'kategori',
        'isi',
        'rating',
        'verified',
    ];

    protected $casts = [
        'anonim'   => 'boolean',
        'verified' => 'boolean',
        'rating'   => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori) {
            'transparansi' => 'Transparansi Dana',
            'barang'       => 'Distribusi Barang',
            'layanan'      => 'Layanan & Respon Admin',
            'website'      => 'Kemudahan Website',
            default        => 'Lainnya',
        };
    }
}