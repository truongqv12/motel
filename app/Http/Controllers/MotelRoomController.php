<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotelRoomRequest;
use App\Models\Amenities;
use App\Models\MotelAmenities;
use App\Models\MotelRoom;
use App\Transformers\MotelRoomTransformer;
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

        return view('frontend.includes.category', compact('motels', 'category'));
    }

    public function detail($cat_id, $rewrite)
    {
        $motel = $this->motelRepository->getByRewrite($rewrite);
        if (!$motel) {
            return redirect(route('index'));
        }

        $meta = [
            'title'          => $motel->get('title'),
            'description'    => htmlentities($motel->get('title')),
            'keywords'       => $motel->get('title'),
            'og:description' => htmlentities($motel->get('title')),
            'og:title'       => $motel->get('title'),
        ];

        \Meta::set($meta);

        return view('frontend.includes.motel_detail', compact('motel'));
    }

    public function search(Request $rq)
    {
        $paginator = $this->motelRepository->search($rq);
//dd($pagin);
        $motels = $paginator->getCollection();

        $motels = transformer_collection_paginator($motels, new MotelRoomTransformer(), $paginator);

        $motels = $motels['data'] ? collect_recursive($motels['data']) : false;

        return view('frontend.includes.search', compact('paginator','motels'));
    }

    public function showFormPostMotel()
    {
        $cities    = $this->citiesRepository->allCity();
        $amenities = $this->motelRepository->allAmenities();
        $typeRoom  = $this->categoryRepository->allByType();

        return view('frontend.includes.post_motel', compact('cities', 'amenities', 'typeRoom'));
    }

    public function postMotel(MotelRoomRequest $rq)
    {
        $latlng    = [];
        $ame_ids   = [];
        $amenities = '';
        $images    = '';
        $latlng[]  = $rq->maps['maps_maplat'];
        $latlng[]  = $rq->maps['maps_maplng'];

        if ($rq->images) {
            $images = explode(',', $rq->images);
        }

        if ($rq->maps) {
            $images = explode(',', $rq->images);
        }

        if ($rq->amenities) {
            $items = Amenities::whereIn('id', $rq->amenities)->get();
            $amenities = $items->pluck('name');
            $ame_ids   = $items->pluck('id');
        }
        $amenities = json_encode($amenities, JSON_FORCE_OBJECT);

        $rq->merge(
            [
                'images'    => json_encode($images, JSON_FORCE_OBJECT),
                'latlng'    => json_encode($latlng, JSON_FORCE_OBJECT),
                'amenities' => base64_encode($amenities),
                'dis_id'    => $rq->district,
                'slug'      => \Illuminate\Support\Str::slug($rq->title, '-'),
                'use_id'    => auth()->user()->id,
                'price'     => str_replace('.', '', $rq->price)
            ]
        );
        $rq->offsetunset('_token');
        $rq->offsetunset('maps');
        $rq->offsetunset('district');
        // create
        $motel = MotelRoom::create($rq->all());
        if ($motel) {
            foreach ($ame_ids ?: [] as $item) {
                $list_style = [
                    'amenities_id' => $item,
                    'motelroom_id' => $motel->id,
                ];
                MotelAmenities::create($list_style);
            }
            return redirect()->route('index')->with('success', 'Thêm mới sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm mới sản phẩm thất bại, vui lòng thử lại');
        }
    }

    public function updateStatusMotel($id,$status) {

        $room = MotelRoom::findOrFail($id);

        $room->status = $status;

        if ($room->save()) {
            return redirect()->back()->with('success', 'Thay đổi trạng thái phòng thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
