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
        'isi',
        'rating',
    ];

    protected $casts = [
        'rating'     => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELASI ====================

    // Belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Belongs to ProgramDonasi (nullable)
    public function programDonasi()
    {
        return $this->belongsTo(ProgramDonasi::class, 'program_donasi_id');
    }

    // ==================== SCOPE ====================

    // Filter berdasarkan rating minimum
    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating', '>=', $rating);
    }

    // Filter berdasarkan program donasi
    public function scopeByProgram($query, $programId)
    {
        return $query->where('program_donasi_id', $programId);
    }
}