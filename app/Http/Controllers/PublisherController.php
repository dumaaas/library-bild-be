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
     * @param  Publisher $publisher
     * @return void
     */
    public function showEditPublisher(Publisher $publisher) {

        $viewName = $this->viewFolder . '.editPublisher';

        $viewModel = [
            'publisher' => $publisher
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Prikazi stranicu za unos novog izdavaca
     *
     * @return void
     */
    public function showAddPublisher() {

        $viewName = $this->viewFolder . '.addPublisher';

        return view($viewName);
    }

    /**
     * Prikazi sve izdavace
     *
     * @param  PublisherService $publisherService
     * @return void
     */
    public function showPublishers(PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.publishers';

        $viewModel = [
            'publishers' => $publisherService->getPublishers()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    /**
     * Izmijeni podatke o izdavacu
     *
     * @param  Publisher $publisher
     * @param  PublisherService $publisherService
     * @return void
     */
    public function updatePublisher(Publisher $publisher, PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.editPublisher';

        $viewModel = [
            'publisher' => $publisher
        ];

        $publisherService->editPublisher($publisher);
        
        //return back to the publisher
        return redirect('publishers')->with('success', 'Izdavač je uspješno izmijenjen!');
    }

    /**
     * Izbrisi izdavaca
     *
     * @param  Publisher $publisher
     */
    public function deletePublisher(Publisher $publisher) {
        Publisher::destroy($publisher->id);
        return back()->with('success', 'Izdavač je uspješno izbrisan!');
    }

    /**
     * Kreiraj i sacuvaj novog izdavaca
     *
     * @param  Publisher $publisher
     * @param  PublisherService $publisherService
     */
    public function savePublisher(Publisher $publisher, PublisherService $publisherService) {

        $viewName = $this->viewFolder . '.editPublisher';

        $viewModel = [
            'publisher' => $publisher
        ];

        $publisherService->savePublisher($publisher);

        //return back to the publisher
        return redirect('publishers')->with('success', 'Izdavač je uspješno unesen!');
    }
}
