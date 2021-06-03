<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\Rent;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| DashboardService
|--------------------------------------------------------------------------
|
| DashboardService je odgovaran za svu logiku koja se desava
| unutar DashboardControllera. Ovdje je moguce definisati sve
| pomocne metode koji su potrebni.
|
*/

class DashboardService
{
    /**
     * Vrati poslednje 4 rezervacije iz baze
     *
     * @return void
     */
    public function getLatestReservation() {
        return Reservation::with('book', 'student')
                    ->latest()
                    ->take(4)
                    ->get();
    }

    /**
     * Vrati sve aktivnosti
     *
     * @return void
     */
    public function getActivities() {
        return Rent::with('book', 'student', 'librarian')
                    ->orderBy('rent_date', 'DESC')
                    ->get();

    }

    /**
     * Vrati ooslednjih 10 aktivnosti
     *
     * @return void
     */
    public function getLatestActivities() {
        return Rent::with('book', 'student', 'librarian')
                    ->orderBy('rent_date', 'DESC')
                    ->take(10)
                    ->get();
    }

    /**
     * Vrati aktivnosti za konkretnu knjigu
     *
     * @param  Book  $knjiga
     * @return void
     */
    public function getBookActivity($knjiga) {
        return Rent::with('book', 'student', 'librarian')
                        ->where('book_id', 'LIKE', $knjiga)
                        ->orderBy('rent_date', 'DESC');
    }

    /**
     * Filtiraj aktivnosti po trazenim uslovima
     *
     * @param  Request  $uceniciRequest
     * @param  Request  $bibliotekariRequest
     * @param  Request  $knjigeRequest
     * @param  Request  $datumOdRequest
     * @param  Request  $datumDoRequest
     * @return void
     */
    public function filterActivities($uceniciRequest, $bibliotekariRequest, $knjigeRequest, $datumOdRequest, $datumDoRequest) {
        $aktivnosti = Rent::query();
        $aktivnosti = $aktivnosti->with('book', 'student', 'librarian');

        if($uceniciRequest) {
            $ucenici    = $uceniciRequest;
            $aktivnosti = $aktivnosti->whereIn('student_id', $ucenici);
        }

        if($bibliotekariRequest) {
            $bibliotekari = $bibliotekariRequest;
            $aktivnosti   = $aktivnosti->whereIn('librarian_id', $bibliotekari);
        }

        if($knjigeRequest) {
            $knjige     = $knjigeRequest;
            $aktivnosti = $aktivnosti->whereIn('book_id', $knjige);
        }

        if($datumOdRequest && $datumDoRequest) {
            $datumOd    = $datumOdRequest;
            $datumDo    = $datumDoRequest;
            $aktivnosti = $aktivnosti->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        return $aktivnosti->orderBy('rent_date', 'DESC')->get();
    }

}
