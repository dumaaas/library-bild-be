<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Script;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ScriptService {
    
    /**
     * Vrati sva pisma iz baze podataka
     *
     * @return void
     */
    public function getScripts(){
        return $pisma = DB::table('scripts');
    }

    /**
     * Izvrsi validaciju podataka i edituj pismo
     *
     * @param  Script $pismo
     * @return void
     */
    public function editScript($pismo){

        //request all data, validate and update script
        request()->validate([
            'nazivPismoEdit' => 'string|max:256',
        ]);

        $pismo->name = request('nazivPismoEdit');

        $pismo->save();
   }

   /**
     * Kreiraj novo pismo i sacuvaj ga u bazi
     *
     * @return void
     */
    public function saveScript(){

        //request all data, validate and update script
        request()->validate([
            'nazivPismo'=>'required|string|max:256',
        ]);

        $pisma = new Script();

        $pisma->name=request('nazivPismo');

        $pisma->save();
    }

}