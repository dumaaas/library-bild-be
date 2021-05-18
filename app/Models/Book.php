<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function rent(){
        return $this->hasMany(Rent::class);
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }
}
