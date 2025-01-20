<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'player_name',
        'player_nim'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}

