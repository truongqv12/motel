<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends FrontEndController
{
    public function index() {
        $profile = Auth::user();
        return view('frontend.includes.profile_setting',compact('profile'));
    }
}
