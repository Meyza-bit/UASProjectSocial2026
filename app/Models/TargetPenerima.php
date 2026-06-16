<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetPenerima extends Model
{
    use HasFactory;

    protected $table = 'target_penerima'; // Sesuaikan jika nama tabel di database berbeda

    protected $fillable = [
        'nama_target', // sesuaikan kolom name di database kamu
        'deskripsi'
    ];

    public function programDonasi()
    {
        return $this->hasMany(ProgramDonasi::class, 'id_target');
    }
}