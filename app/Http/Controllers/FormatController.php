<?php

namespace App\Http\Controllers;
use App\Models\Format;
use DB;
use Illuminate\Http\Request;
use App\Services\FormatService;

class FormatController extends Controller
{
    
    private $viewFolder = 'pages/settings/format';

     /**
     * Prikazi stranicu za editovanje formata
     *
     * @param  Format $format
     * @return void
     */
    public function prikaziEditFormat(Format $format) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format'=>$format
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Prikazi stranicu za unos novog formata
     *
     * @return void
     */
    public function prikaziNoviFormat() {

        $viewName = $this->viewFolder . '.noviFormat';

        return view($viewName);
    }

    /**
     * Prikazi sve formate
     *
     * @param  FormatService $formatService
     * @return void
     */
    public function prikaziSettingsFormat(FormatService $formatService) {

        $viewName = $this->viewFolder . '.settingsFormat';

        $viewModel = [
            'formati' => $formatService->getFormats()->paginate(7)
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Kreiraj i sacuvaj novi format
     *
     * @param  Format $format
     * @param  FormatService $formatService
     */
    public function sacuvajFormat(Format $format, FormatService $formatService) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format' => $format
        ];

        $formatService->saveFormat($format);

        return redirect('settingsFormat')->with('success', 'Format uspjesno sacuvan!');
    }

    /**
     * Izmijeni podatke o formatu
     *
     * @param  Format $format
     * @param  FormatService $formatService
     * @return void
     */
    public function izmijeniFormat(Format $format, FormatService $formatService) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format' => $format
        ];

        $formatService->editFormat($format);

        //return back to all genres
        return redirect('settingsFormat')->with('success', 'Format uspjesno izmijenjen!');
    }

    /**
     * Izbrisi format
     *
     * @param  Format $format
     */
    public function izbrisiFormat(Format $format) {
    
        Format::destroy($format->id);
        return back()->with('success', 'Format uspjesno izbrisan!');
    }
}
