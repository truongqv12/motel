<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends BackendController
{
    public function index()
    {
        $posts   = Post::with('category')->get();
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

    public function store(PostRequest $rq)
    {
        $rq->offsetunset('_token');
        $imgName = '';
        if ($rq->hasFile('upload_image')) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/photos';

            $image   = $rq->file('upload_image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgName);
        }
        $rq->offsetUnset('upload_image');
        $rq->merge([
            'pos_image'   => $imgName,
            'pos_rewrite' => \Illuminate\Support\Str::slug($rq->pos_title, '-'),
        ]);;

        if (Post::create($rq->except('upload_image'))) {
            return redirect()->back()->with('success', 'Thêm mới bài viết thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm mới bài viết thất bại, vui lòng thử lại');
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
