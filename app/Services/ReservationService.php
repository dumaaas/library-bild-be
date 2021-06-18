<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Carbon\Carbon;
use Auth;

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
    public function getActiveReservations() {
        return Reservation::with('book', 'student')
                    ->where('closeReservation_id', '=', null);
    }

    /**
     * Vrati sve arhivirane rezervacije
     *
     * @return void
     */
    public function getArchivedReservations() {
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
                    ->where('closeReservation_id', '=', 5);
    }

    /**
     * Vrati konkretnu rezervaciju
     *
     * @return void
     */
    public function getRezervacija($knjiga, $ucenik) {
        return Reservation::where('book_id', '=', $knjiga)
                                ->where('student_id', '=', $ucenik)
                                ->where('closeReservation_id', '=', 5)
                                ->first();
    }

    /**
     * Updateuj status rezervacije za konkretnu rezervaciju
     *
     * @param  Book  $knjiga
     * @return void
     */
    public function updateReservationStatus($rezervacija) {
        $reservationStatus = ReservationStatus::find($rezervacija);
        $reservationStatus->statusReservation_id = 2;
        $reservationStatus->save();
    }

    /**
     * Sacuvaj rezervaciju
     *
     * @param  Book  $knjiga
     * @return void
     */
    public function saveReservation($knjiga, $globalVariableService) {
        $rezervisanje = new Reservation();

        $rezervisanje->book_id             = $knjiga;
        $rezervisanje->librarian_id        = Auth::id();
        $rezervisanje->student_id          = request('ucenik');
        $rezervisanje->reservation_date    = request('datumRezervisanja');
        $rezervisanje->close_date          = $rezervisanje->reservation_date->addDays($globalVariableService->getRokRezervacije());
        $rezervisanje->request_date        = now();
        $rezervisanje->closeReservation_id = 5;

        $rezervisanje->save();

        return $rezervisanje;
    }

    /**
     * Sacuvaj status rezervacije
     *
     * @param  int $rezervacijaId
     * @param  date $rezervacijaDate
     * @return void
     */
    public function saveReservationStatus($rezervacijaId, $rezervacijaDate) {
        $statusRezervisanja = new ReservationStatus();

        $statusRezervisanja->reservation_id       = $rezervacijaId;
        $statusRezervisanja->statusReservation_id = 1;
        $statusRezervisanja->date                 = $rezervacijaDate;

        $statusRezervisanja->save();
    }

    /**
     * Vrati pretrazene aktivne rezervacije / Nije testirano!
     *
     * @return void
     */
    public function searchAktivneRezervacije() {

        $aktivne = Reservation::query();

        $aktivne = $this->getAktivneRezervacije();

        if(request('searchAktivne')) {
            $knjiga = request('searchAktivne');
            $aktivne = $aktivne->where(function ($query) {
                $query->select('title')
                    ->from('books')
                    ->whereColumn('books.id', 'reservations.book_id');
            }, 'LIKE', '%'.$knjiga.'%');
        }

        $aktivne = $aktivne->paginate(7);

        return $aktivne;
    }

    /**
     * Vrati pretrazene arhivirane rezervacije
     *
     * @return void
     */
    public function searchArhiviraneRezervacije() {

        $arhivirane = Reservation::query();

        $arhivirane = $this->getArhiviraneRezervacije();

        if(request('searchArhivirane')) {
            $knjiga = request('searchArhivirane');
            $arhivirane = $arhivirane->where(function ($query) {
                $query->select('title')
                    ->from('books')
                    ->whereColumn('books.id', 'reservations.book_id');
            }, 'LIKE', '%'.$knjiga.'%');
        }

        $arhivirane = $arhivirane->paginate(7);

        return $arhivirane;
    }

    public function getTransakcija($knjiga, $ucenik) {
        return Reservation::with('book', 'student', 'librarian')
            ->where('book_id', '=', $knjiga)
            ->where('student_id', '=', $ucenik)
            ->first();
    }
}
