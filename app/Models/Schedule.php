<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'category',
        'team1',
        'team2',
        'location',
        'date',
        'time'
    ];
}
