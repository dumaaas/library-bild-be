<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function prikaziBibliotekara(User $bibliotekar) {
        return view('bibliotekarProfile', [
            'bibliotekar' => $bibliotekar
        ]);
    }

    public function prikaziBibliotekare() {
        return view('bibliotekari', [
            'bibliotekari' => User::with('userType')->where('userType_id', '=', 2)->paginate(7)
        ]);
    }

    public function prikaziEditBibliotekar() {
        return view('editBibliotekar');
    }

    public function prikaziEditUcenik() {
        return view('editUcenik');
    }

    public function prikaziNoviBibliotekar() {
        return view('noviBibliotekar');
    }
    public function prikaziUcenike() {
        return view('ucenik');
    }
    public function prikaziUcenikProfile() {
        return view('ucenikProfile');
    }
    public function prikaziNovogUcenika() {
        return view('noviUcenik');
    }

    public function prikaziUcenikIzdate() {
        return view('ucenikIzdate');
    }

    public function prikaziUcenikVracene() {
        return view('ucenikVracene');
    }

    public function prikaziUcenikPrekoracenje() {
        return view('ucenikPrekoracenje');
    }

    public function prikaziUcenikAktivne() {
        return view('ucenikAktivne');
    }

    public function prikaziUcenikArhivirane() {
        return view('ucenikArhivirane');
    }
}
