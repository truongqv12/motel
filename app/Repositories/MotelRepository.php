<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\MotelRoom;
use App\Transformers\MotelRoomTransformer;

class MotelRepository implements MotelInterface
{
    public function all($per_page = 20)
    {
        $motels = MotelRoom::where('status', '1')->paginate($per_page);
        return (isset($motels)) ? $motels : false;
    }

    public function allByCat($cat_id, $per_page = 20)
    {
        $motels = MotelRoom::where('status', '1')
            ->where('category_id', $cat_id)
            ->paginate($per_page);
        return $motels ?: false;
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

    public function getByRewrite($rewrite)
    {
        $motel = MotelRoom::where('slug', '=', $rewrite)->first();

        if ($motel) {
            $motel = transformer_item($motel, new MotelRoomTransformer(), ['user', 'city', 'district', 'ward', 'category']);
        }
        return ($motel) ? collect_recursive($motel) : false;
    }

    public function search($rq)
    {
        $paginator = MotelRoom::where('status', 1)
            ->address()->city_id()->district_id()->price()
            ->orderBy('id', "DESC")
            ->paginate(30);

        $motels = $paginator->getCollection();

        $motels = transformer_collection_paginator($motels, new MotelRoomTransformer(), $paginator);

        return $motels['data'] ? collect_recursive($motels) : false;
    }

}
