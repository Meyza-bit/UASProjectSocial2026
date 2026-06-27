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

    public function targetPenerima()
    {
        return $this->belongsTo(TargetPenerima::class, 'id_target', 'id_target');
    }

    public function donasiDana()
    {
        return $this->hasMany(DonasiDana::class, 'id_program', 'id');
    }

    public function donasiDanas()
    {
        return $this->donasiDana();
    }

    public function donasiBarangs()
    {
        return $this->hasMany(DonasiBarang::class, 'program_donasi_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'program_donasi_id');
    }

    public function feedbacks()
    {
        return $this->feedback();
    }

    public function getPresentaseAttribute()
    {
        if ($this->target_dana == 0) return 0;
        return round(($this->dana_terkumpul / $this->target_dana) * 100);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeDarurat($query)
    {
        return $query->where('status', 'darurat');
    }
}
