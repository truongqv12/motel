<?php

namespace App\Http\Controllers\Backend;

use App\Models\MotelRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MotelController extends Controller
{

    public function index()
    {
        $motels  = MotelRoom::with('category')->paginate(10);
        $columns = [
            'ID', 'Tiêu đề', 'Danh mục', 'Giá phòng', 'Trạng thái', 'Hành động'
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
        if (auth('admin')->user()->delete != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        $motel  = MotelRoom::findOrFail($id);
        $images = json_decode($motel->images, 1);

        if ($motel->delete()) {
            foreach ($images as $item) {
                $image_path = public_path() . "/upload/motel/" . $item;
                if (\File::exists($image_path)) {
                    \File::delete($image_path);
                }
            }
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa không thành công');
        }
    }
}
