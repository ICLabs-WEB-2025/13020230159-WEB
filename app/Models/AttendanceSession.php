<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
     protected $fillable = [
        'token',
        'name',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

}
