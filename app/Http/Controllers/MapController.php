<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends FrontEndController
{
    public function index()
    {
        $motels = $this->motelRepository->all();

        if (!$motels) {
            return redirect(route('index'));
        }

        $motels_json = json_encode($motels->toArray());

        return view('frontend.includes.map', compact('motels_json'));
    }
}
