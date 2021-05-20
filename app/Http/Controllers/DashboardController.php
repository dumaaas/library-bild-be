<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\Rent;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\Console\Input\Input;

class DashboardController extends Controller
{
    public function prikaziDashboard() {
        return view('dashboard', [
            'rezervacije' => Reservation::with('book', 'student')->latest()->take(4)->get(),
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->orderBy('rent_date', 'DESC')->take(10)->get(),
            'prekoraceneNum' => Rent::where('return_date', '=', null)->where('rent_date', '<', Carbon::now()->subDays(30))->count(),
            'rezervisaneNum' => Reservation::where('close_date', '=', null)->count(),
            'izdateNum' => Rent::where('return_date', '=', null)->count(),
        ]);
    }

    public function prikaziDashboardAktivnost() {
        return view('dashboardAktivnost', [
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->orderBy('rent_date', 'DESC')->get(),
            'knjiga' => null,
            'ucenici' => User::where('userType_id', '=', 3)->get(),
            'bibliotekari' => User::where('userType_id', '=', 2)->get(),
            'knjige' => Book::all(),
        ]);
    }

    public function prikaziDashboardAktivnostKonkretneKnjige(Book $knjiga) {
        return view('dashboardAktivnost', [
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->get(),
            'knjiga' => $knjiga,
        ]);
    }

    public function filterAktivnosti(Request $request) {
        $aktivnosti = Rent::query();
        $aktivnosti = $aktivnosti->with('book', 'student', 'librarian');
        if($request->ucenici) {
            $ucenici = $request->ucenici;
            $aktivnosti =  $aktivnosti->where('student_id', '=', $ucenici);
        }
        if($request->bibliotekari) {
            $bibliotekari = $request->bibliotekari;
            $aktivnosti = $aktivnosti->where('librarian_id', '=', $bibliotekari);
        }

        if($request->knjige) {
            $knjige = $request->knjige;
            $aktivnosti = $aktivnosti->where('book_id', '=', $knjige);
        }

        if($request->datumOd && $request->datumDo) {
            $datumOd = $request->datumOd;
            $datumDo = $request->datumDo;
            $aktivnosti = $aktivnosti->whereBetween('rent_date', [$datumOd, $datumDo]);
        }

        $aktivnosti = $aktivnosti->orderBy('rent_date', 'DESC')->get();

        return response()->json([
            "aktivnosti" => $aktivnosti,
            'knjiga' => null,
            'ucenici' => User::where('userType_id', '=', 3)->get(),
            'bibliotekari' => User::where('userType_id', '=', 2)->get(),
            'knjige' => Book::all(),
        ]);
    }
}
