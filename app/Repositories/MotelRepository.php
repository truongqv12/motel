<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Amenities;
use App\Models\MotelRoom;
use App\Models\Reports;
use App\Models\UserMotel;
use App\Transformers\AmenitiesTransformer;
use App\Transformers\MotelRoomTransformer;
use App\Transformers\UserMotelTransformer;
use Illuminate\Support\Facades\DB;

class MotelRepository implements MotelInterface
{
    public function all()
    {
        $motels = MotelRoom::where('status', '1')->get();
        $motels = transformer_collection($motels, new MotelRoomTransformer());
        return ($motels) ? collect_recursive($motels) : false;
    }

//    public
    public function newMotel($limit = 10)
    {
        $motels = MotelRoom::where('status', '1')
            ->orderBy('id', "DESC")
            ->limit($limit)
            ->get();
        $motels = transformer_collection($motels, new MotelRoomTransformer());
        return $motels ? collect_recursive($motels) : false;
    }

    public function allByCatId($cat_id)
    {
        $paginator = MotelRoom::where('status', 1)
            ->where('category_id', $cat_id)
            ->orderBy('id', "DESC")
            ->paginate(30);

        $motels = $paginator->getCollection();

        $motels = transformer_collection_paginator($motels, new MotelRoomTransformer(), $paginator);

        return $motels['data'] ? collect_recursive($motels) : false;
    }

    public function allByUseNeed($use_need = 1)
    {
        $paginator = MotelRoom::where('status', 1)
            ->where('use_need', $use_need)
            ->orderBy('id', "DESC")
            ->paginate(30);

        $motels = $paginator->getCollection();

        $motels = transformer_collection_paginator($motels, new MotelRoomTransformer(), $paginator);

        return $motels['data'] ? collect_recursive($motels) : false;
    }

    public function getByRewrite($rewrite)
    {
        $motel = MotelRoom::where('status', '=', 1)->where('slug', '=', $rewrite)->first();

        if ($motel) {
            $motel = transformer_item($motel, new MotelRoomTransformer(), ['user', 'city', 'district', 'ward', 'category']);
        }
        return ($motel) ? collect_recursive($motel) : false;
    }

    public function getById($id, $admin = false)
    {
        $motel = MotelRoom::where('id', $id);

        if (!$admin) {
            $motel = $motel->where('status', '=', 1)->where('use_id', auth()->user()->id);
        }

        $motel = $motel->first();

        if ($motel) {
            $motel = transformer_item($motel, new MotelRoomTransformer(), ['user', 'city', 'district', 'ward', 'category']);
        }

        return ($motel) ? collect_recursive($motel) : false;
    }

    public function search($rq)
    {
        $paginator = MotelRoom::where('status', 1)
            ->address()->city_id()->district_id()->price()->amenities($rq->amenities)
            ->orderBy('id', "DESC")
            ->paginate(30);
        return $paginator;
//        $motels = $paginator->getCollection();
//
//        $motels = transformer_collection_paginator($motels, new MotelRoomTransformer(), $paginator);
//
//        return $motels['data'] ? collect_recursive($motels) : false;
    }

    public function allAmenities()
    {
        $items = Amenities::all();
        $items = transformer_collection($items, new AmenitiesTransformer());
        return ($items) ? collect_recursive($items) : false;
    }

    public function myMotel()
    {
        $items = MotelRoom::where('use_id', '=', auth()->user()->id)->get();
        $items = transformer_collection($items, new MotelRoomTransformer());
        return $items ? collect_recursive($items) : false;
    }

    public function myMotelSave()
    {
        $items = UserMotel::with(['motel' => function ($q) {
            return $q->where('status', 1);
        }])->where('user_id', auth()->user()->id)
            ->get();
        $save  = [];
        foreach ($items as $item) {
            if ($item->motel != null) {
                $save[] = $item;
            }
        }
        $items = transformer_collection($save, new UserMotelTransformer());
        return $items ? collect_recursive($items) : false;
    }

    public function visited($id)
    {
        MotelRoom::where('id', $id)
            ->update([
                'total_view' => DB::raw('total_view + 1')
            ]);
    }
}
