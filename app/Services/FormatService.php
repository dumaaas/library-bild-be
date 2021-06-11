<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Format;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormatService {

    /**
     * Vrati sve formate iz baze podataka
     *
     * @return void
     */
    public function getFormats(){
        return $formati = DB::table('formats');
    }
       
    /**
     * Kreiraj novi format i sacuvaj ga u bazi
     *
     * @return void
     */
    public function saveFormat(){

        //request all data, validate and add format
        request()->validate([
            'nazivFormat'=>'required|string|max:256',
        ]);

        $formati = new Format();

        $formati->name=request('nazivFormat');

        $formati->save();
    
    }

    /**
     * Izvrsi validaciju podataka i edituj format
     *
     * @param  Format $format
     * @return void
     */
    public function editFormat($format){

        //request all data, validate and update genre
        request()->validate([
            'nazivFormatEdit'=>'string|max:256',
        ]);

        $format->name=request('nazivFormatEdit');

        $format->save();
    
    }
    
}