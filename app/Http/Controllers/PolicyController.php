<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalVariable;

class PolicyController extends Controller
{

    private $viewFolder = 'pages/settings/policy';

    /**
     * Prikazi sve polise
     *
     * @return void
     */
    public function prikaziSettingsPolisa() {

        $viewName = $this->viewFolder . '.settingsPolisa';

        $viewModel=[
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'rokRezervacije' => GlobalVariable::find(2),
            'rokPrekoracenja' => GlobalVariable::find(3)
        ];

        return view($viewName, $viewModel);
    }

    public function izmijeniRokRezervacije(){

         //request all data, validate and update RESERVATION_PERIOD
         request()->validate([
            'rokRezervacije' => 'numeric|sometimes|max:256',
        ]);

        $rezervacija = GlobalVariable::find(2);
        $rezervacija->value = request('rokRezervacije');
        $rezervacija->save();

        return back()->with('success', 'Uspjesno izmijenjen rok rezervacije!');
    }

    public function izmijeniRokPozajmljivanja(){

         //request all data, validate and update RETURN_DUE_DATE
         request()->validate([
            'rokPozajmljivanja' => 'numeric|sometimes|max:256',
        ]);

        $rezervacija = GlobalVariable::find(1);
        $rezervacija->value = request('rokPozajmljivanja');
        $rezervacija->save();

        return back()->with('success', 'Uspjesno izmijenjen rok pozajmljivanja!');
    }

    public function izmijeniRokPrekoracenja(){

        //request all data, validate and update OVERDRAFT_PERIOD
        request()->validate([
            'rokPrekoracenja' => 'numeric|sometimes|max:256',
        ]);

        $rezervacija = GlobalVariable::find(3);
        $rezervacija->value = request('rokPrekoracenja');
        $rezervacija->save();

        return back()->with('success', 'Uspjesno izmijenjen rok prekoracenja!');
    }
}
