<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use DB;
use Illuminate\Http\Request;
use App\Services\PublisherService;

class PublisherController extends Controller
{

    private $viewFolder = 'pages/settings/publishers';

    /**
     * Prikazi stranicu za editovanje izdavaca
     *
     * @param  Publisher $izdavac
     * @return void
     */
    public function prikaziEditIzdavac(Publisher $izdavac) {

        $viewName = $this->viewFolder . '.editIzdavac';

        $viewModel = [
            'izdavac' => $izdavac
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za unos novog izdavaca
     *
     * @return void
     */
    public function prikaziNoviIzdavac() {

        $viewName = $this->viewFolder . '.noviIzdavac';

        return view($viewName);
    }

    /**
     * Prikazi sve izdavace
     *
     * @param  PublisherService $publisherService
     * @return void
     */
    public function prikaziSettingsIzdavac(PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.settingsIzdavac';

        $viewModel = [
            'izdavaci' => $publisherService->getPublishers()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Izmijeni podatke o izdavacu
     *
     * @param  Publisher $izdavac
     * @param  PublisherService $publisherService
     * @return void
     */
    public function izmijeniIzdavaca(Publisher $izdavac, PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.editIzdavac';

        $viewModel = [
            'izdavac' => $izdavac
        ];

        $publisherService->editPublisher($izdavac);
        
        //return back to the publisher
        return redirect('settingsIzdavac')->with('success', 'Izdavac uspjesno izmjenjen!');
    }

    /**
     * Izbrisi izdavaca
     *
     * @param  Publisher $izdavac
     */
    public function izbrisiIzdavaca(Publisher $izdavac) {
        Publisher::destroy($izdavac->id);
        return back()->with('success', 'Izdavac uspjesno izbrisan!');
    }

    /**
     * Kreiraj i sacuvaj novog izdavaca
     *
     * @param  Publisher $izdavac
     * @param  PublisherService $publisherService
     */
    public function sacuvajIzdavaca(Publisher $izdavac, PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.editIzdavac';

        $viewModel = [
            'izdavac' => $izdavac
        ];

        $publisherService->savePublisher($izdavac);

        //return back to the publisher
        return redirect('settingsIzdavac')->with('success', 'Izdavac uspjesno sacuvan!');
    }
}
