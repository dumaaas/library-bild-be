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

    public function izmijeniRok(){

         //request all data, validate and update RESERVATION_PERIOD, OVERDRAFT_PERIOD, RETURN_DUE_DATE
         request()->validate([
            'rokRezervacije' => 'numeric|nullable|max:256',
            'rokPozajmljivanja' => 'numeric|nullable|max:256',
            'rokPrekoracenja' => 'numeric|nullable|max:256',
        ]);

        $rokPozajmljivanja = GlobalVariable::find(1);
        $rokRezervacije = GlobalVariable::find(2);
        $rokPrekoracenja = GlobalVariable::find(3);

        if(request('rokPozajmljivanja')) {
            $rokPozajmljivanja->value = request('rokPozajmljivanja');
        }

        if(request('rokRezervacije')) {
            $rokRezervacije->value = request('rokRezervacije');
        }

        if(request('rokPrekoracenja')) {
            $rokPrekoracenja->value = request('rokPrekoracenja');
        }

        $rokPozajmljivanja->save();
        $rokRezervacije->save();
        $rokPrekoracenja->save();

        return back()->with('success', 'Rok je uspješno izmijenjen!');
    }

}
