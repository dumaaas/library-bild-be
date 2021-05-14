<?php

namespace App\Http\Controllers;
use App\Models\Script;
use DB;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function prikaziEditPismo(Script $pismo) {
        return view('editPismo',[
        'pismo'=>$pismo
        ]);
    }
    public function prikaziSettingsPismo() {
        return view('settingsPismo',[
            'pisma'=>DB::table('scripts')->paginate(7)
        ]);
    }
    public function prikaziNovoPismo() {
        return view('novoPismo');
    }

    public function sacuvajPismo() {
        //request all data, validate and update script
        request()->validate([
            'nazivPismo'=>'required',
        ]);

        $pisma = new Script();

        $pisma->name=request('nazivPismo');

        $pisma->save();

        //return back
        return back();
    }

    public function izmijeniPismo(Script $pismo) {
        //request all data, validate and update script
        request()->validate([
            'nazivPismoEdit'=>'required',
        ]);

        $pismo->name=request('nazivPismoEdit');

        $pismo->save();

        //return back to the script
        return view('editPismo', [
            'pismo' => $pismo
        ]);
    }

    public function izbrisiPismo(Script $pismo) {
        Script::destroy($pismo->id);
        return back();
    }
}
