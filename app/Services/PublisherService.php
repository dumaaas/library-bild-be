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
}