<?php

namespace App\Http\Controllers;
use App\Models\Format;
use DB;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    
    private $viewFolder = 'pages/settings/format';

    public function prikaziEditFormat(Format $format) {

        $viewName = $this->viewFolder . '.editFormat';

        return view($viewName,[
            'format'=>$format
        ]);
    }

    public function prikaziNoviFormat() {

        $viewName = $this->viewFolder . '.noviFormat';

        return view($viewName);
    }

    public function prikaziSettingsFormat() {

        $viewName = $this->viewFolder . '.settingsFormat';

        return view($viewName,[
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
