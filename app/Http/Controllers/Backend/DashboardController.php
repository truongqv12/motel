<?php

namespace App\Http\Controllers\Backend;

use App\Models\MotelRoom;
use App\Models\Reports;
use App\Models\User;

class DashboardController extends BackendController
{
    public function index()
    {
        $motels_active = MotelRoom::where('status', 1)->count();
        $motels_hide   = MotelRoom::where('status', 0)->count();
        $users        = User::count();
        $reports      = Reports::count();

        return view('backend.dashboard.index', compact('motels_active',
            'motels_hide',
            'users',
            'reports')
        );
    }

    public function fileManager() {
        return view('backend.dashboard.file');
    }
}
