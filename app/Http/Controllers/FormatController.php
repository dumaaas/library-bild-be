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

    public function sacuvajFormat(Format $format,FormatService $formatService) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format' => $format
        ];

        $formatService->saveFormat($format);

        return back()->with('success', 'Format uspjesno sacuvan!');
    }

    public function izmijeniFormat(Format $format, FormatService $formatService) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format' => $format
        ];

        $formatService->editFormat($format);

        //return back to all genres
        return back()->with('success', 'Format uspjesno izmijenjen!');
    }

    public function izbrisiFormat(Format $format) {
    
        Format::destroy($format->id);
        return redirect('settingsFormat');
    }
}
