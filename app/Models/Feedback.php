<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';

    protected $fillable = [
        'nama',
        'anonim',
        'peran',
        'rating',
        'kategori',
        'isi',
        'verified',
    ];

    protected $casts = [
        'anonim'   => 'boolean',
        'verified' => 'boolean',
        'rating'   => 'integer',
    ];

    // Label kategori yang enak dibaca (dipakai di kartu ulasan)
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