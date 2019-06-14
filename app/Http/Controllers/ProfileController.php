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
    public function motelPost() {
        $motels = $this->motelRepository->myMotel();
        return view('frontend.includes.profile_my_motel',compact('motels'));
    }

    public function motelSave() {
        $items = $this->motelRepository->myMotelSave();
        return view('frontend.includes.profile_save_motel',compact('items'));
    }
}
