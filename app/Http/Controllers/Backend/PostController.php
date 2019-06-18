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
        if (auth('admin')->user()->edit != 1) {
            return redirect()->route('administration.index')->with('error', 'Không có quyền truy cập');
        }

        $post = Post::findOrFail($id);

        $categories = $this->categoryRepository->backendAllByType('POST');

        return view('backend.post.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $rq, $id)
    {
        $post = Post::findOrFail($id);

        $rq->offsetunset('_token');
        if ($rq->hasFile('upload_image')) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/photos';

            $image_path = $destinationPath . "/" . $post->pos_image;
            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }

            $image   = $rq->file('upload_image');
            $imgName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgName);
            $post->pos_image = $imgName;
        }

        $post->pos_title           = $rq->pos_title;
        $post->pos_rewrite         = \Illuminate\Support\Str::slug($rq->pos_title, '-');
        $post->pos_teaser          = $rq->pos_teaser;
        $post->pos_content         = $rq->pos_content;
        $post->pos_category_id     = $rq->pos_category_id;
        $post->pos_active          = $rq->pos_active;
        $post->pos_seo_title       = $rq->pos_seo_title;
        $post->pos_seo_keyword     = $rq->pos_seo_keyword;
        $post->pos_seo_description = $rq->pos_seo_description;

        $check = $post->save();
        if ($check){
            return redirect()->route('posts.index')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }

    public function destroy($id)
    {
        //
    }
}
