<?php

namespace App\Http\Controllers;

use App\Models\MotelRoom;
use Illuminate\Http\Request;

class MotelRoomController extends FrontEndController
{
    public function list($rewrite)
    {
        $category = $this->categoryRepository->getByRewrite($rewrite);

        if (!$category) {
            return redirect(route('index'));
        }

        $motels = $this->motelRepository->allByCatId($category->get('id'));

        if (!$motels) {
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

        return view('frontend.includes.category', compact('motels','category'));
    }

    public function detail($cat_id, $rewrite)
    {
        $motel = $this->motelRepository->getByRewrite($rewrite);
        if (!$motel) {
            return redirect(route('index'));
        }

        $meta = [
            'title'          => $motel->get('title'),
            'description'    => htmlentities($motel->get('description')),
            'keywords'       => $motel->get('title'),
            'og:description' => htmlentities($motel->get('description')),
            'og:title'       => $motel->get('title'),
        ];

        \Meta::set($meta);

        return view('frontend.includes.motel_detail', compact('motel'));
    }

    public function search(Request $rq)
    {
        $motels = $this->motelRepository->search($rq);

        return view('frontend.includes.search', compact('motels'));
    }
}
