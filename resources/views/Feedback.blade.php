<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'id_user',
        'id_program',
        'rating',
        'isi',
    ];

    protected $casts = [
        'rating'     => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────

    /** Feedback ditulis oleh user */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /** Feedback terkait dengan program donasi */
    public function program()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_program');
    }

    // ── Accessor ───────────────────────────────────────────

    /**
     * Ubah angka rating jadi simbol bintang.
     * Contoh: 4 → "★★★★☆"
     * Akses: $feedback->bintang
     */
    public function getBintangAttribute(): string
    {
        $rating = (int) $this->rating;
        return str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
    }

    // ── Scopes ─────────────────────────────────────────────

    /**
     * Hanya feedback dengan rating >= 4.
     * Penggunaan: Feedback::ratingTinggi()->get()
     */
    public function scopeRatingTinggi($query)
    {
        return $query->where('rating', '>=', 4);
    }
}