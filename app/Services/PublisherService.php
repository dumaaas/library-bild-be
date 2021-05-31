<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Publisher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PublisherService {
    
    public function getPublishers(){
        return $izdavaci = DB::table('publishers');
    }

    public function editPublisher($izdavac){

        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavacEdit' => 'required|max:256',
        ]);

        $izdavac->name = request('nazivIzdavacEdit');

        $izdavac->save();
    }

    public function savePublisher(){

        //request all data, validate and update publisher
        request()->validate([
            'nazivIzdavac' => 'required|max:256',
        ]);

        $izdavac = new Publisher();

        $izdavac->name = request('nazivIzdavac');

        $izdavac->save();
        
    }
    
}