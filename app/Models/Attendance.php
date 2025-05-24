<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'waktu_presensi'];

    protected static function booted()
{
    static::creating(function ($attendance) {
        if (empty($attendance->user_id)) {
            $attendance->user_id = auth()->id();
        }
        if (empty($attendance->waktu_presensi)) {
            $attendance->waktu_presensi = now();
        }
    });
}

    public function user()
{
    return $this->belongsTo(User::class);
    //return $this->belongsTo(\App\Models\User::class, 'user_id');
}

}
