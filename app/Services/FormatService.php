<?php

namespace App\Services;

use DB;
use Illuminate\Http\Request;
use App\Models\Format;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormatService {

    public function getFormats(){
        return $formati = DB::table('formats');
    }
        
    public function saveFormat(){

        //request all data, validate and add format
        request()->validate([
            'nazivFormat'=>'required|max:256',
        ]);

        $formati = new Format();

        $formati->name=request('nazivFormat');

        $formati->save();
    
    }

    public function editFormat($format){

        //request all data, validate and update genre
        request()->validate([
            'nazivFormatEdit'=>'required|max:256',
        ]);

        $format->name=request('nazivFormatEdit');

        $format->save();
    
    }
    
}