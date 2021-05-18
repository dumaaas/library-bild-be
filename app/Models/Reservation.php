<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at', 'reservation_date'];


    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function reservationStatus(){
        return $this->belongsTo(ReservationStatus::class, 'student_id');
    }
}
