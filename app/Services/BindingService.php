<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Binding;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BindingService {
    
    /**
     * Vrati sve poveze iz baze podataka
     *
     * @return void
     */
    public function getBindings(){
        return $povezi = DB::table('bindings');
    }

    /**
     * Izvrsi validaciju podataka i edituj povez
     *
     * @param  Binding  $povez
     * @return void
     */
    public function editBinding($povez){

        //request all data, validate and update binding
        request()->validate([
          'nazivPovezEdit' => 'string|max:256',
        ]);

        $povez->name = request('nazivPovezEdit');

        $povez->save();

   }

    /**
     * Kreiraj novi povez i sacuvaj ga u bazi
     *
     * @return void
     */
    public function saveBinding(){
        
        //request all data, validate and update binding
        request()->validate([
        'nazivPovez'=>'required|string|max:256',
        ]);
        
        $povez = new Binding();
        
        $povez->name=request('nazivPovez');
        
        $povez->save();

    }

}