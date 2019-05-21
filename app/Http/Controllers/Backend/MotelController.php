<?php

namespace App\Http\Controllers\Backend;

use App\Models\MotelRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MotelController extends Controller
{

    public function index()
    {
        $motels = MotelRoom::with('category')->paginate(10);
        $columns = [
            'ID', 'Tiêu đề', 'Danh mục', 'Giá phòng', 'Trạng thái' ,'Hành động'
        ];
        return view('backend.motel.index', compact('motels', 'columns'));
    }

    public function create()
    {
        //
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
