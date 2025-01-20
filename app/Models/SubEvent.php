<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    use HasFactory;

    protected $table = 'subevents';

    protected $fillable = [
        'name',
        'description',
        'category',
        'start_date',
        'end_date',
        'image',
        'rules_file'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'subevent_id');
    }
}
