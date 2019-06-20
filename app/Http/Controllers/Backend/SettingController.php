<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SettingRequest;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function index()
    {
        $settings = SettingWebsite::all();
        $columns  = [
            'ID', 'Tên', 'Mã', 'Giá trị', 'Hàng động'
        ];
        return view('backend.setting.index', compact('settings', 'columns'));
    }

    public function create()
    {
        return view('backend.setting.add');

    }

    public function store(SettingRequest $rq)
    {

        $rq->offsetunset('_token');
        if ($rq->swe_type == 'plain_text') {
            $rq->merge([
                'value' => $rq->swe_value_plain_text,
            ]);
        } elseif ($rq->swe_type == 'image') {
            $imgName = '';
            if ($rq->hasFile('swe_value_image')) {
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/files';

                $image   = $rq->file('swe_value_image');
                $imgName = time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imgName);
            }
            $rq->merge([
                'value' => $imgName,
                'type'  => $rq->swe_type,
            ]);
        }
        $rq->offsetunset('swe_type');
        $rq->offsetunset('swe_value_plain_text');

        $check = SettingWebsite::create($rq->except('swe_value_image'));

        if ($check) {
            return redirect()->back()->with('success', 'Tạo setting thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm mới thất bại, vui lòng thử lại');
        }

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $rq, $id)
    {
        //
    }

    public function destroy($id)
    {
        if (auth('admin')->user()->delete != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        $setting = SettingWebsite::findOrFail($id);

        if ($setting->delete()) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa không thành công');
        }

    }
}
