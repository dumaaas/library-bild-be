<?php

namespace App\Http\Controllers;

use App\Models\Binding;
use DB;
use Illuminate\Http\Request;

class BindingController extends Controller
{
    public function prikaziEditPovez(Binding $povez) {
        return view('editPovez', [
            'povez' => $povez
        ]);
    }

    public function prikaziNoviPovez() {
        return view('noviPovez');
    }

    public function prikaziSettingsPovez() {
        return view('settingsPovez', [
            'povezi' => DB::table('bindings')->paginate(7)
        ]);
    }

    public function sacuvajPovez() {
        //request all data, validate and update binding
        request()->validate([
            'nazivPovez'=>'required',
        ]);

        $povez = new Binding();

        $povez->name=request('nazivPovez');

        $povez->save();

        //return back
        return back();
    }

    public function izmijeniPovez(Binding $povez) {
        //request all data, validate and update binding
        request()->validate([
            'nazivPovezEdit'=>'required',
        ]);

        $povez->name=request('nazivPovezEdit');

        $povez->save();

        //return back to the binding
        return view('editPovez', [
            'povez' => $povez
        ]);
    }

    public function izbrisiPovez(Binding $povez) {
        Binding::destroy($povez->id);
        return back();
    }
}
