<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'target_amount',
        'current_amount',
        'category',
        'description',
    ];
}