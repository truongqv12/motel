<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends FrontEndController
{
    public function index()
    {
        $profile = Auth::user();
        return view('frontend.includes.profile_setting', compact('profile'));
    }

    public function update(Request $rq)
    {

        $profile = Auth::user();
        $user    = User::findOrFail($profile->id);

        $user->address = $rq->address;
        $user->active  = $rq->active;
        $user->gender  = $rq->gender;
        $check         = $user->save();
        if ($check) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại, vui lòng thử lại');
        }
    }

    public function editPass(Request $rq)
    {
        $this->validate($rq,
            [
                'password_new' => 'required|min:6',
            ],[
                'password_new.required' => 'Bạn chưa nhập mật khẩu mới',
                'password_new.min' => 'Mật khẩu không được ngắn hơn 6 ký tự',
            ]
        );

        $profile = Auth::user();
        $user    = User::findOrFail($profile->id);

        $rq->offsetunset('_token');
        $hasher = app('hash');

        if ($hasher->check($rq->password_old, $user->password)) {
            $user->password = $rq->password_new;
        } else {
            return redirect(route('profile').'#tabs-2')->with('error', 'Mật khẩu cũ không đúng');
        }

        $check = $user->save();
        if ($check) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại, vui lòng thử lại');
        }
    }

    public function motelPost()
    {
        $motels = $this->motelRepository->myMotel();
        return view('frontend.includes.profile_my_motel', compact('motels'));
    }

    public function motelSave()
    {
        $items = $this->motelRepository->myMotelSave();
        return view('frontend.includes.profile_save_motel', compact('items'));
    }
}
