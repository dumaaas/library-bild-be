<?php

namespace App\Http\Controllers;
use App\Models\Format;
use DB;
use Illuminate\Http\Request;
use App\Services\FormatService;

class FormatController extends Controller
{
    
    private $viewFolder = 'pages/settings/format';

    public function prikaziEditFormat(Format $format) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format'=>$format
        ];

        return view($viewName,$viewModel);
    }

    public function prikaziNoviFormat() {

        $viewName = $this->viewFolder . '.noviFormat';

        return view($viewName);
    }

    public function prikaziSettingsFormat(FormatService $formatService) {

        $viewName = $this->viewFolder . '.settingsFormat';

        $viewModel = [
            'formati' => $formatService->getFormats()->paginate(7)
        ];

        return view($viewName,$viewModel);
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
            'nazivFormatEdit'=>'required|',
        ]);

        $format->name=request('nazivFormatEdit');

        $format->save();

        //return back to all genres
        return back()->with('success', 'Format uspjesno izmijenjen!');
    }

    public function izbrisiFormat(Format $format) {
    
        Format::destroy($format->id);
        return redirect('settingsFormat');
    }
}
