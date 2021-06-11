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
        return $izdavaci = DB::table('publishers');
    }

    /**
     * Izvrsi validaciju podataka i edituj izdavaca
     *
     * @param  Publisher $izdavac
     * @return void
     */
    public function editPublisher($izdavac){

        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavacEdit' => 'string|max:256',
        ]);

        $izdavac->name = request('nazivIzdavacEdit');

        $izdavac->save();
    }

    /**
     * Kreiraj novog izdavaca i sacuvaj ga u bazi
     *
     * @return void
     */
    public function savePublisher(){

        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavac' => 'required|string|max:256',
        ]);

        $izdavac = new Publisher();

        $izdavac->name = request('nazivIzdavac');

        $izdavac->save();
        
    }
    
}