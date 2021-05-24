<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalVariable;

class PolicyController extends Controller
{
    public function prikaziSettingsPolisa() {
        return view('settingsPolisa', [
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'rokRezervacije' => GlobalVariable::find(2),
            'rokPrekoracenja' => GlobalVariable::find(3)
        ]);
    }

    public function izmijeniRokRezervacije(){
        $rezervacija = GlobalVariable::find(2);
        $rezervacija->value = request('rokRezervacije');
        $rezervacija->save();

        return view('settingsPolisa', [
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'rokRezervacije' => $rezervacija,
            'rokPrekoracenja' => GlobalVariable::find(3)
        ]);
    }

    public function izmijeniRokPozajmljivanja(){
        $rezervacija = GlobalVariable::find(1);
        $rezervacija->value = request('rokPozajmljivanja');
        $rezervacija->save();

        return view('settingsPolisa', [
            'rokPozajmljivanja' => $rezervacija,
            'rokRezervacije' => GlobalVariable::find(2),
            'rokPrekoracenja' => GlobalVariable::find(3)
        ]);
    }

    public function izmijeniRokPrekoracenja(){
        $rezervacija = GlobalVariable::find(3);
        $rezervacija->value = request('rokPrekoracenja');
        $rezervacija->save();

        return view('settingsPolisa', [
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'rokRezervacije' => GlobalVariable::find(2),
            'rokPrekoracenja' => $rezervacija
        ]);
    }
}
