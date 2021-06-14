<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use DB;

class GaleryController extends Controller
{

    private $viewFolderBook = 'pages/knjiga';

    /**
     * Izbrisi sliku
     *
     * @param  User $user
     * @return void
     */
    public function deleteImage(Galery $slika) {

        Galery::destroy($slika->id);
        return back()->with('success','Slika je uspješno obrisana!');
    }
}
