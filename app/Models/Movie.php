<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'description',
        'poster',
        'TypeOfFilm',
        'duration',
    ];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
