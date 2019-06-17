<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends BackendController
{

    public function index()
    {
        $users = $this->userRepository->all();
        $columns = [
            'ID','Họ tên', 'Avatar', 'Email', 'Active', 'SĐT', 'Địa chỉ', 'Hành động'
        ];
        return view('backend.user.index',compact('users','columns'));
    }

    public function create()
    {
        return view('backend.user.add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:4|confirmed',
                'phone'  => 'min:4| max:15',
                'upload_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'name.required' => 'Họ tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.confirmed' => 'Mật khẩu không khớp',
                'password.min' => 'Mật khẩu quá ngắn',
                'phone.min' => 'Số điện thoại không đúng',
                'phone.max' => 'Số điện thoại không đúng',
                'upload_avatar.image' => 'File phải là ảnh',
                'upload_avatar.max' => 'Dung lượng file quá lớn',
            ]
        );

        $request->offsetunset('_token');
        $imgName = '';
        if($request->hasFile('upload_avatar')){
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/user';

            $image      = $request->file('upload_avatar');
            $imgName   = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgName);
        }

        $request->merge([
            'avatar' => $imgName,
            'password' => $request->password
        ]);

        if (User::create($request->all())) {
            return redirect()->back()->with('success','Thêm mới tài khoản người dùng thành công');
        }else{
            return redirect()->back()->with('error','Thêm mới tài khoản thất bại, vui lòng thử lại');
        }
    }

    public function edit($id)
    {
        $user = $this->userRepository->findById($id);

        return view('backend.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->findById($id);
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id.',id',
                'phone'  => 'min:4| max:15',
                'upload_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'name.required' => 'Họ tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng',
                'email.unique' => 'Email đã tồn tại',
                'phone.min' => 'Số điện thoại không đúng',
                'phone.max' => 'Số điện thoại không đúng',
                'upload_avatar.image' => 'File phải là ảnh',
                'upload_avatar.max' => 'Dung lượng file quá lớn',
            ]
        );
        $request->offsetunset('_token');
        if($request->hasFile('upload_avatar')){
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/user';

            $image_path = $destinationPath . "/" . $user->avatar;
            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }

            $image      = $request->file('upload_avatar');
            $imgName   = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgName);
            $user->avatar = $imgName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->active = $request->active;
        $check = $user->save();
        if ($check){
            return redirect()->route('users.index')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }


    public function destroy($id)
    {
        $user = $this->userRepository->findById($id);

        if ($user->delete()) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/user';

            $image_path = $destinationPath . "/" . $user->avatar;
            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }
            return redirect()->back()->with('success','Xóa thành công');
        }
        else {
            return redirect()->back()->with('error','Xóa không thành công');
        }
    }
}
