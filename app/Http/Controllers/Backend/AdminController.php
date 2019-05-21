<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\AdminUser;

class AdminController extends BackendController
{

    public function index()
    {
        $admins = AdminUser::where('id', '<>', auth('admin')->user()->id)
            ->where('id', '<>', 1)
            ->get();

        $columns = [
            'Username', 'Họ tên', 'Email', 'Hành động'
        ];
        return view('backend.admin.index',
            compact('admins', 'columns')
        );
    }

    public function create()
    {
        if (auth('admin')->user()->add != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        return view('backend.admin.add');
    }

    public function store(AdminCreateRequest $request)
    {
        $check = $this->adminRepository->createAdmin($request);

        if ($check) {
            return redirect(route('administration.index'))->with('success', 'Thêm mới tài khoản quản trị thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm mới tài khoản thất bại, vui lòng thử lại');
        }
    }

    public function edit($id)
    {
        if (auth('admin')->user()->edit != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        $admin = $this->adminRepository->findById($id);

        return view('backend.admin.edit', compact('admin'));
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $admin = $this->adminRepository->updateAdmin($request, $id);
        if ($admin) {
            return redirect()->route('administration.index')->with('success', 'Sửa tài khoản thành công');
        } else {
            return redirect()->back()->with('error', 'Sửa tài khoản thất bại, vui lòng thử lại');
        }
    }

    public function destroy($id)
    {
        if (auth('admin')->user()->delete != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        $admin = $this->adminRepository->deleteAdmin($id);

        if ($admin) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa không thành công');
        }
    }
}
