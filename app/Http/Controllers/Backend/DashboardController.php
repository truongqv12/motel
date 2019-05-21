<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BackendController
{
    public function index()
    {
        return view('backend.dashboard.index');
    }
}
