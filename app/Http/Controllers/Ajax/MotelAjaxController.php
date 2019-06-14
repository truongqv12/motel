<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Reports;
use App\Models\UserMotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MotelAjaxController extends AjaxController
{
    public function report(Request $rq)
    {
        $result = [
            'error'   => 1,
            'message' => 'Bạn không thể báo cáo tin này'
        ];

        $arr   = [
            'ip_address'   => get_user_ip(),
            'motelroom_id' => $rq->motel_id,
            'status'       => $rq->report_status,
            'user_id'      => auth()->user()->id,
        ];
        $check = Reports::create($arr);
        if ($check) {
            $result = [
                'error'   => 0,
                'message' => 'Cảm ơn bạn đã báo cáo, đội ngũ chúng tôi sẽ xem xét ngay'
            ];
        }

        return json_encode($result);
    }

    public function save(Request $rq)
    {
        $result = [
            'error'   => 1,
            'message' => 'Bạn đã lưu tin này rồi'
        ];

        $exit = UserMotel::where('user_id', auth()->user()->id)
            ->where('motelroom_id', $rq->motel_id)
            ->get();

        if ($exit->isEmpty()) {
            $arr   = [
                'motelroom_id' => $rq->motel_id,
                'user_id'      => auth()->user()->id,
            ];
            $check = UserMotel::create($arr);
            if ($check) {
                $result = [
                    'error'   => 0,
                    'message' => 'Bạn đã lưu tin thành công !!!'
                ];
            }
        }

        return json_encode($result);
    }

    public function unSave($id)
    {
        $result = [
            'error'   => 1,
            'message' => 'Có lỗi xảy ra vui lòng thử lại !!!'
        ];
        $umotel = UserMotel::findOrFail($id);

        if ($umotel->delete()) {
            $result = [
                'error'   => 0,
                'message' => 'Đã bỏ lưu tin !!!'
            ];
        }

        return json_encode($result);
    }
}
