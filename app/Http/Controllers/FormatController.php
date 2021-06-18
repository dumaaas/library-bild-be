<?php

namespace App\Http\Controllers;
use App\Models\Format;
use DB;
use Illuminate\Http\Request;
use App\Services\FormatService;

class FormatController extends Controller
{
    
    private $viewFolder = 'pages/settings/formats';

     /**
     * Prikazi stranicu za editovanje formata
     *
     * @param  Format $format
     * @return void
     */
    public function showEdit(Format $format) {

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
    public function showAdd() {

        $viewName = $this->viewFolder . '.addFormat';

        return view($viewName);
    }

    /**
     * Prikazi sve formate
     *
     * @param  FormatService $formatService
     * @return void
     */
    public function index(FormatService $formatService) {

        $viewName = $this->viewFolder . '.formats';

        $viewModel = [
            'formats' => $formatService->getFormats()->paginate(7)
        ];

        return view($viewName,$viewModel);
    }

    /**
     * Kreiraj i sacuvaj novi format
     *
     * @param  Format $format
     * @param  FormatService $formatService
     */
    public function save(Format $format, FormatService $formatService) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format' => $format
        ];

        $formatService->saveFormat($format);

        return redirect('formats')->with('success', 'Format je uspješno unesen!');
    }

    /**
     * Izmijeni podatke o formatu
     *
     * @param  Format $format
     * @param  FormatService $formatService
     * @return void
     */
    public function update(Format $format, FormatService $formatService) {

        $viewName = $this->viewFolder . '.editFormat';

        $viewModel = [
            'format' => $format
        ];

        $formatService->editFormat($format);

        //return back to all genres
        return redirect('formats')->with('success', 'Format je uspješno izmijenjen!');
    }

    /**
     * Izbrisi format
     *
     * @param  Format $format
     */
    public function delete(Format $format) {
    
        Format::destroy($format->id);
        return back()->with('success', 'Format je uspješno izbrisan!');
    }
}
