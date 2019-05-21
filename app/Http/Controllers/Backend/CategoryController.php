<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BackendController
{

    public function index(Request $rp)
    {
        $cat_type = $rp->has('type') ? $rp->get('type') : '';

        if (!in_array($cat_type, config('type'))) {
            return view('backend.layout.404');
        };

        $categories = $this->categoryRepository->backendAllByType($cat_type);

        if (!$categories) {
            return view('backend.layout.404');
        };
        $columns = [
            'ID', 'Tên danh mục', 'Link', 'Active', 'Hành động'
        ];
        return view('backend.category.index', compact('categories', 'columns'));
    }

    public function create(Request $rp)
    {
        if (auth('admin')->user()->add != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }

        $cat_type = $rp->has('type') ? $rp->get('type') : '';

        if (!in_array($cat_type, config('type'))) {
            return view('backend.layout.404');
        };

        $categories = $this->categoryRepository->backendAllByType($cat_type);

        return view('backend.category.add', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $check = $this->categoryRepository->createCategory($request);

        if ($check) {
            return redirect()->back()->with('success', 'Thêm mới danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm mới thất bại, vui lòng thử lại');
        }

    }

    public function edit($id)
    {
        if (auth('admin')->user()->edit != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        $cat = $this->categoryRepository->findById($id);
        $categories = $this->categoryRepository->allNotMyChild($id);
        return view('backend.category.edit', compact('cat', 'categories'));
    }

    public function update(CategoryRequest $request, $id)
    {

        $redirectLink = $this->categoryRepository->updateCategory($request, $id);
        if ($redirectLink) {
            return redirect($redirectLink)->with('success', 'Sửa thành công');
        } else {
            return redirect()->back()->with('error', 'Sửa thất bại, vui lòng thử lại');
        }
    }

    public function destroy($id)
    {
        if (auth('admin')->user()->delete != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }
        $cat = Category::findOrFail($id);

        if ($cat->childs->count() == 0) {
            if ($cat->delete()) {
                return redirect()->back()->with('success', 'Xóa thành công');
            } else {
                return redirect()->back()->with('error', 'Xóa không thành công');
            }
        }
        return redirect()->back()->with('error', 'Xóa thất bại');
    }
}
