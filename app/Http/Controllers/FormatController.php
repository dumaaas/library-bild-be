<?php

namespace App\Http\Controllers;
use App\Models\Format;
use DB;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function prikaziEditFormat(Format $format) {
        return view('editFormat',[
            'format'=>$format
        ]);
    }

    public function prikaziNoviFormat() {
        return view('noviFormat');
    }

    public function prikaziSettingsFormat() {
        return view('settingsFormat',[
            'formati'=>DB::table('formats')->paginate(7)
        ]);
    }

    public function sacuvajFormat() {
        //request all data, validate and add format
        request()->validate([
            'nazivFormat'=>'required',
        ]);

        $formati = new Format();

        $formati->name=request('nazivFormat');

        $formati->save();

        return redirect('settingsFormat');
    }

    public function izmijeniFormat(Format $format) {
        //request all data, validate and update genre
        request()->validate([
            'nazivFormatEdit'=>'required',
        ]);

        $format->name=request('nazivFormatEdit');

        $format->save();

        //return back to all genres
        return redirect('settingsFormat');
    }

    public function izbrisiFormat(Format $format) {
        Format::destroy($format->id);
        return redirect('settingsFormat');
    }
}
