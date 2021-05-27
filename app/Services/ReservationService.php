<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| ReservationService
|--------------------------------------------------------------------------
|
| ReservationService je odgovaran za svu logiku koja se desava 
| unutar ReservationControllera. Ovdje je moguce definisati sve 
| pomocne metode koji su potrebni.
|
*/

class ReservationService 
{
    /**
     * Vrati sve aktivne rezervacije
     *
     * @return void
     */
    public function getAktivneRezervacije() {
        return Reservation::with('book', 'student')
                    ->where('closeReservation_id', '=', null);
    }

    /**
     * Vrati sve arhivirane rezervacije
     *
     * @return void
     */
    public function getAhriviraneRezervacije() {
        return Reservation::with('book', 'student', 'reservationStatus')
                    ->where('closeReservation_id', '!=', null);
    }

    /**
     * Vrati sve rezervisane knjige
     *
     * @return void
     */
    public function getRezervisaneKnjige() {
        return Reservation::with('book', 'student', 'reservationStatus')
                    ->where('closeReservation_id', '!=', 5);
    }
}