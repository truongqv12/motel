<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends FrontEndController
{
    public function index() {
        return view('frontend.includes.map');
    }
}
