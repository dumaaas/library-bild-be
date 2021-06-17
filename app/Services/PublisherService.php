<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Publisher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PublisherService {
    
    /**
     * Vrati sve izdavace iz baze podataka
     *
     * @return void
     */
    public function getPublishers(){
        return $publishers = DB::table('publishers');
    }

    /**
     * Izvrsi validaciju podataka i edituj izdavaca
     *
     * @param  Publisher $publisher
     * @return void
     */
    public function editPublisher($publisher){

        //request all data, validate and update publisher
        request()->validate([
            'publisherNameEdit' => 'string|max:256',
        ]);

        $publisher->name = request('publisherNameEdit');

        $publisher->save();
    }

    /**
     * Kreiraj novog izdavaca i sacuvaj ga u bazi
     *
     * @return void
     */
    public function savePublisher(){

        //request all data, validate and update publisher
        request()->validate([
            'publisherName' => 'required|string|max:256',
        ]);

        $publisher = new Publisher();

        $publisher->name = request('publisherName');

        $publisher->save();
        
    }
    
}