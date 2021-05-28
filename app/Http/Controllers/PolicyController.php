<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalVariable;

class PolicyController extends Controller
{
    
    private $viewFolder = 'pages/settings/policy';

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

        $viewName = $this->viewFolder . '.settingsPolisa';

        $rezervacija = GlobalVariable::find(2);
        $rezervacija->value = request('rokRezervacije');
        $rezervacija->save();

        return view($viewName, [
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'rokRezervacije' => $rezervacija,
            'rokPrekoracenja' => GlobalVariable::find(3)
        ]);
    }

    public function izmijeniRokPozajmljivanja(){

        $viewName = $this->viewFolder . '.settingsPolisa';

        $rezervacija = GlobalVariable::find(1);
        $rezervacija->value = request('rokPozajmljivanja');
        $rezervacija->save();

        return view($viewName, [
            'rokPozajmljivanja' => $rezervacija,
            'rokRezervacije' => GlobalVariable::find(2),
            'rokPrekoracenja' => GlobalVariable::find(3)
        ]);
    }

    public function izmijeniRokPrekoracenja(){

        $viewName = $this->viewFolder . '.settingsPolisa';

        $rezervacija = GlobalVariable::find(3);
        $rezervacija->value = request('rokPrekoracenja');
        $rezervacija->save();

        return view($viewName, [
            'rokPozajmljivanja' => GlobalVariable::find(1),
            'rokRezervacije' => GlobalVariable::find(2),
            'rokPrekoracenja' => $rezervacija
        ]);
    }
}
