<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Book;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class RentController extends Controller
{

    public function prikaziIzdavanjeDetalji(Book $knjiga, User $ucenik) {
        $transakcija = Rent::with('book', 'student', 'librarian')->where('book_id', '=', $knjiga->id)->where('student_id', '=', $ucenik->id)->first();
        if($transakcija != null) {
            return view('izdavanjeDetalji', [
                'transakcija' => $transakcija
            ]);
        } else {
            return view('izdavanjeDetaljiError', [
                'knjiga' => $knjiga,
                'ucenik' => $ucenik,
            ]);
        }

    }

    public function prikaziKnjigePrekoracenje() {

        $prekoracene = Rent::where('return_date', '<', Carbon::now())->where(function ($query) {
            $query->select('statusBook_id')
                ->from('rent_statuses')
                ->whereColumn('rent_statuses.rent_id', 'rents.id')
                ->orderByDesc('rent_statuses.date')
                ->limit(1);
        }, 2);

        return view('knjigePrekoracenje',[
            'prekoracene' => $prekoracene->paginate(7),
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

    public function prikaziIzdateKnjige() {

        // pokupi samo knjige sa statusom izdatata
        $izdate = Rent::where(function ($query) {
            $query->select('statusBook_id')
                ->from('rent_statuses')
                ->whereColumn('rent_statuses.rent_id', 'rents.id')
                ->orderByDesc('rent_statuses.date')
                ->limit(1);
        }, 2);

        return view('izdateKnjige', [
            'izdate' => $izdate->paginate(7),
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

    public function prikaziVraceneKnjige() {

        // pokupi samo knjige sa statusom izdatata
        $vracene = Rent::where(function ($query) {
            $query->select('statusBook_id')
                ->from('rent_statuses')
                ->whereColumn('rent_statuses.rent_id', 'rents.id')
                ->orderByDesc('rent_statuses.date')
                ->limit(1);
        }, 1)->orWhere(function ($query) {
            $query->select('statusBook_id')
                ->from('rent_statuses')
                ->whereColumn('rent_statuses.rent_id', 'rents.id')
                ->orderByDesc('rent_statuses.date')
                ->limit(1);
        }, 3);

        return view('vraceneKnjige', [
            'vracene' => $vracene->paginate(7),
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

    public function prikaziAktivneRezervacije() {
        return view('aktivneRezervacije', [
            'aktivne' => Reservation::with('book', 'student')->where('closeReservation_id', '=', null)->paginate(7),
        ]);
    }

    public function prikaziArhiviraneRezervacije() {
        return view('arhiviraneRezervacije', [
            'arhivirane' => Reservation::with('book', 'student', 'reservationStatus')->where('closeReservation_id', '!=', null)->paginate(7),
        ]);
    }

    public function izbrisiTransakciju(Book $knjiga, User $ucenik) {
        $transakcija = Rent::where('book_id', '=', $knjiga->id)->where('student_id', '=', $ucenik->id)->first();
        Rent::destroy($transakcija->id);

        return view('izdateKnjige', [
            'izdate' => Rent::with('book', 'student', 'librarian')->where('return_date', '=', null)->paginate(7),
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

    public function filterIzdateKnjige() {
        $izdate = Rent::query();
        $izdate = $izdate->with('book', 'student', 'librarian')->where('return_date', '=', null);
        if(request('uceniciFilter')) {
            $ucenici = request('uceniciFilter');
            $izdate = $izdate->whereIn('student_id', $ucenici);
        }

        if(request('bibliotekariFilter')) {
            $bibliotekari = request('bibliotekariFilter');
            $izdate = $izdate->whereIn('librarian_id', $bibliotekari);
        }

        if(request('filterDatumOd') && request('filterDatumDo')) {
            $datumOd = request('filterDatumOd');
            $datumDo = request('filterDatumDo');
            $izdate = $izdate->whereBetween('rent_date', [$datumOd, $datumDo]);
        }


        $izdate = $izdate->paginate(7);


        return view('izdateKnjige', [
            'izdate' => $izdate,
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

    public function filterVraceneKnjige() {
        $vracene = Rent::query();
        $vracene = $vracene->with('book', 'student', 'librarian')->where('return_date', '!=', null);

        if(request('uceniciFilter')) {
            $ucenici = request('uceniciFilter');
            $vracene = $vracene->whereIn('student_id', $ucenici);
        }

        if(request('bibliotekariFilter')) {
            $bibliotekari = request('bibliotekariFilter');
            $vracene = $vracene->whereIn('librarian_id', $bibliotekari);
        }

        if(request('filterDatumOd') && request('filterDatumDo')) {
            $datumOd = request('filterDatumOd');
            $datumDo = request('filterDatumDo');
            $vracene = $vracene->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        if(request('filterVracenaOd') && request('filterVracenaDo')) {
            $vracenaOd = request('filterVracenaOd');
            $vracenaDo = request('filterVracenaDo');
            $vracene = $vracene->whereBetween('return_date', [$vracenaOd, $vracenaDo]);
        }


        $vracene = $vracene->paginate(7);


        return view('vraceneKnjige', [
            'vracene' => $vracene,
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

    public function filterPrekoraceneKnjige() {
        $prekoracene = Rent::query();
        $prekoracene = $prekoracene->with('book', 'student', 'librarian')->where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30));

        if(request('uceniciFilter')) {
            $ucenici = request('uceniciFilter');
            $prekoracene = $prekoracene->whereIn('student_id', $ucenici);
        }

        if(request('filterDatumOd') && request('filterDatumDo')) {
            $datumOd = request('filterDatumOd');
            $datumDo = request('filterDatumDo');
            $prekoracene = $prekoracene->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        $prekoracene = $prekoracene->paginate(7);

        return view('knjigePrekoracenje',[
            'prekoracene' => $prekoracene,
            'ucenici' => DB::table('users')->where('userType_id', '=', 3)->get(),
            'bibliotekari' => DB::table('users')->where('userType_id', '=', 2)->get(),
        ]);
    }

}
