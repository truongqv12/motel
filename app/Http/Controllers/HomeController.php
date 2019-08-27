<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RyanNielson\Meta\Facades\Meta;

class HomeController extends FrontEndController
{
    public function index()
    {

        $cities    = $this->citiesRepository->allCity();
        $motels    = $this->motelRepository->newMotel(18);
        $amenities = $this->motelRepository->allAmenities();

        return view('frontend.includes.home', compact('cities', 'motels', 'amenities'));
    }

    protected function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('frontend.auth.login');
    }

    protected function signupForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('frontend.auth.register');
    }
}
