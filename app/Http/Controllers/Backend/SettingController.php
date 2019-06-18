<?php

namespace App\Http\Controllers\Backend;

use App\Models\SettingWebsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function index()
    {
        $settings   = SettingWebsite::all();
        $columns = [
            'ID', 'Tên', 'Mã', 'Giá trị', 'Hàng động'
        ];
        return view('backend.setting.index', compact('settings', 'columns'));
    }

    public function create()
    {
        return view('backend.setting.add');

    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
