<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WisataAdmin;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = WisataAdmin::all();
        // dd($wisata);
        return view('pengguna.wisata.wisata', compact(['wisata']), ["title" => "Wisata"]);
    }
}
