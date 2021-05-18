<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Reservation;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class RentController extends Controller
{

    public function prikaziIzdavanjeDetalji() {
        return view('izdavanjeDetalji');
    }

    public function prikaziKnjigePrekoracenje() {
//        $now = Carbon::now();
//        $knjige = Rent::with('book', 'student', 'librarian')->where('return_date', '=', null);
//        $prekoracene = collect();
//        foreach ($knjige as $knjiga) {
//            if($knjiga->rent_date->addDays(30)->gt($now)) {
//
//                $prekoracene->add($knjiga);
//            }
//        }
        return view('knjigePrekoracenje',[
            'prekoracene' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->paginate(7),
        ]);
    }

    public function prikaziIzdateKnjige() {
        return view('izdateKnjige', [
            'izdate' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->paginate(7),
        ]);
    }

    public function prikaziVraceneKnjige() {
        return view('vraceneKnjige', [
            'vracene' => Rent::with('book', 'student', 'librarian')->where('return_date', '!=', null)->paginate(7),
        ]);
    }

    public function prikaziAktivneRezervacije() {
        return view('aktivneRezervacije', [
            'aktivne' => Reservation::with('book', 'student')->where('close_date', '=', null)->paginate(7),
        ]);
    }

    public function prikaziArhiviraneRezervacije() {
        return view('arhiviraneRezervacije', [
            'arhivirane' => Reservation::with('book', 'student', 'reservationStatus')->where('close_date', '!=', null)->paginate(7),
        ]);
    }

}
