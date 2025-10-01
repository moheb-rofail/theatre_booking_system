<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function movies() {
        return $this->hasMany(Movie::class);
    }
}
