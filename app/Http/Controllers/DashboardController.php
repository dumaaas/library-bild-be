<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\Rent;

use Carbon\Carbon;
use Illuminate\Http\Request;

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
            'knjiga' => null
        ]);
    }

    public function prikaziDashboardAktivnostKonkretneKnjige(Book $knjiga) {
        return view('dashboardAktivnost', [
            'aktivnosti' => Rent::with('book', 'student', 'librarian')->where('book_id', 'LIKE', $knjiga->id)->orderBy('rent_date', 'DESC')->get(),
            'knjiga' => $knjiga,
        ]);
    }
}
