<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Binding;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BindingService {
    
    public function getBindings(){
        return $povezi = DB::table('bindings');
    }

    public function editBinding($povez){

        //request all data, validate and update binding
        request()->validate([
          'nazivPovezEdit' => 'required|max:256',
        ]);

        $povez->name = request('nazivPovezEdit');

        $povez->save();

   }

    public function saveBinding(){
        
        //request all data, validate and update binding
        request()->validate([
        'nazivPovez'=>'required|max:256',
        ]);
        
        $povez = new Binding();
        
        $povez->name=request('nazivPovez');
        
        $povez->save();

    }

}