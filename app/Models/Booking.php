<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function movie() {
        // return $this->hasMany(Movie::class);
        return $this->belongsTo(Movie::class);
    }

    public function user() {
        // return $this->hasMany(User::class);
        return $this->belongsTo(User::class);
    }
}
