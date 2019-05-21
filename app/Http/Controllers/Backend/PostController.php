<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends BackendController
{
    public function index()
    {
        $posts = Post::with('category')->get();
        $columns = [
            'ID', 'Danh mục', 'Ảnh', 'Tiêu đề', 'Link', 'Mô tả ngắn', 'Active', 'Ngày tạo', 'Ngày sửa', 'Hàng động'
        ];
        return view('backend.post.index', compact('posts', 'columns'));
    }

    public function create()
    {
        if (auth('admin')->user()->add != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }

        $categories = $this->categoryRepository->backendAllByType('POST');

        return view('backend.post.add', compact('categories'));
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
