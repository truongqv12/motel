<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RyanNielson\Meta\Facades\Meta;

class HomeController extends FrontEndController
{
    public function index()
    {
//        dd($this->citiesRepository->allCity());
//        $meta = [
//            'title'          => 1,
//            'description'    => 2,
//            'keywords'       => 3,
//            'og:description' => 4,
//            'og:title'       => 5,
//        ];
//
//        Meta::set($meta);
        $cities = $this->citiesRepository->allCity();
        $motels = $this->motelRepository->newMotel(18);

        return view('frontend.includes.home', compact('cities', 'motels'));
    }
}
