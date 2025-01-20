<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'subevent_id',
        'category',
        'captain_name',
        'captain_nim',
        'class',
        'team_name',
        'captain_phone',
        'ktm',
        'payment_proof'
    ];

    public function subEvent()
    {
        return $this->belongsTo(SubEvent::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
