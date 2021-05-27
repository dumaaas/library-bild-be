<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use DB;
use Illuminate\Http\Request;
use App\Services\PublisherService;

class PublisherController extends Controller
{

    private $viewFolder = 'pages/settings/publishers';

    public function prikaziEditIzdavac(Publisher $izdavac) {

        $viewName = $this->viewFolder . '.editIzdavac';

        $viewModel = [
            'izdavac'=>$izdavac
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziNoviIzdavac() {

        $viewName = $this->viewFolder . '.noviIzdavac';

        return view($viewName);
    }

    public function prikaziSettingsIzdavac(PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.settingsIzdavac';

        $viewModel = [
            'izdavaci' => $publisherService->getPublishers()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    public function izmijeniIzdavaca(Publisher $izdavac) {
        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavacEdit'=>'required',
        ]);

        $izdavac->name=request('nazivIzdavacEdit');

        $izdavac->save();

        //return back to the publisher
        return view('editIzdavac', [
            'izdavac' => $izdavac
        ]);
    }

    public function izbrisiIzdavaca(Publisher $izdavac) {
        Publisher::destroy($izdavac->id);
        return back();
    }

    public function sacuvajIzdavaca(Publisher $izdavac) {
        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavac'=>'required',
        ]);

        $izdavac = new Publisher();

        $izdavac->name=request('nazivIzdavac');

        $izdavac->save();

        //return back to the publisher
        return view('editIzdavac', [
            'izdavac' => $izdavac
        ]);
    }
}
