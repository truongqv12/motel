<?php

namespace App\Http\Controllers\Backend;

use App\Models\MotelRoom;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotelController extends BackendController
{

    public function index(Request $rp)
    {
        $motels  = MotelRoom::with('category')->title()->status()->orderBy('id', 'DESC')->paginate(10);
        $title   = $rp->input('title');
        $status  = $rp->input('status');
        $columns = [
            'ID', 'Tiêu đề', 'Danh mục', 'Giá phòng', 'Xem', 'Trạng thái', 'Hành động'
        ];
        return view('backend.motel.index', compact('motels', 'columns', 'title', 'status'));
    }

    public function report()
    {
        $motels  = Reports::leftJoin('motelrooms', 'reports.motelroom_id', '=', 'motelrooms.id')
            ->selectRaw('motelrooms.*, count(reports.motelroom_id) as total_report')
            ->groupBy('reports.motelroom_id')
            ->paginate(10);
        $columns = [
            'ID', 'Bài đăng', 'Số lượt báo cáo', 'Trạng thái', 'Hành động'
        ];
        return view('backend.motel.report', compact('motels', 'columns'));
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function view($id)
    {
        $motel = $this->motelRepository->getById($id, true);
        if (!$motel) {
            return redirect()->back();
        }
        $categories = $this->categoryRepository->allByType("MOTEL");
        $cats_post  = $this->categoryRepository->allByType("POST");
        \View::share(compact('categories', 'cats_post'));
        $meta = [
            'title'          => $motel->get('title'),
            'description'    => htmlentities($motel->get('title')),
            'keywords'       => $motel->get('title'),
            'og:description' => htmlentities($motel->get('title')),
            'og:title'       => $motel->get('title'),
        ];

        \Meta::set($meta);

        return view('frontend.includes.motel_detail', compact('motel'));
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

    public function active($id)
    {

        $room = MotelRoom::findOrFail($id);

        $room->status = 1;

        if ($room->save()) {
            return redirect()->back()->with('success', 'Đã kiểm duyệt bài đăng: ' . $room->title);
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function unactive($id)
    {
        $room = MotelRoom::findOrFail($id);

        $room->status = 0;

        if ($room->save()) {
            return redirect()->back()->with('success', 'Đã ẩn bài đăng: ' . $room->title);
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
