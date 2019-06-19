<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends FrontEndController
{
    public function list($rewrite)
    {
        $category = $this->categoryRepository->getByRewrite($rewrite);

        if (!$category) {
            return redirect(route('index'));
        }

        $posts = $this->postRepository->allByCatId($category->get('id'));

        if (!$posts) {
            return redirect(route('index'));
        }

        $meta = [
            'title'          => $category->get('seo')->get('name') ?: $category->get('name'),
            'description'    => $category->get('seo')->get('description') ?: $category->get('name'),
            'keywords'       => $category->get('seo')->get('keywords') ?: $category->get('name'),
            'og:description' => $category->get('seo')->get('description') ?: $category->get('name'),
            'og:title'       => $category->get('seo')->get('description') ?: $category->get('name'),
        ];

        \Meta::set($meta);

        return view('frontend.includes.post_category', compact('posts', 'category'));
    }

    public function detail($rewrite)
    {
        $detail = $this->postRepository->getByRewrite($rewrite);

        if (!$detail) {
            return redirect(route('index'));
        }

        $this->postRepository->visited($detail->get('id'));
        $meta = [
            'title'          => $detail->get('seo')->get('title') ?? $detail->get('title'),
            'description'    => $detail->get('seo')->get('description') ?: $detail->get('title'),
            'keywords'       => $detail->get('seo')->get('keywords') ?: $detail->get('title'),
            'og:description' => $detail->get('seo')->get('description') ?: $detail->get('title'),
            'og:title'       => $detail->get('seo')->get('title') ?: $detail->get('title'),
        ];
        \Meta::set($meta);

        $posts_same = $this->postRepository->getPostsLimit($detail->get('category_id'), null, 5, false, $detail->get('id'));
        $posts_new  = $this->postRepository->getPostsLimit(null, null, 5, false, $detail->get('id'));

        return view('frontend.includes.post_detail', compact('detail', 'posts_new', 'posts_same'));
    }
}
