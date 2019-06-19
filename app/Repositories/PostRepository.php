<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Support\Facades\DB;


class PostRepository implements PostInterface
{

    public function allByCatId($cat_id)
    {
        $paginator = Post::where('pos_active', 1)
            ->where('pos_category_id', $cat_id)
            ->orderBy('pos_id', "DESC")
            ->paginate(10);

        $items = $paginator->getCollection();

        $items = transformer_collection_paginator($items, new PostTransformer(), $paginator);

        return $items['data'] ? collect_recursive($items) : false;
    }

    public function getByRewrite($rewrite)
    {
        $item = Post::where('pos_active', '=', 1)->where('pos_rewrite', '=', $rewrite)->first();

        if ($item) {
            $item = transformer_item($item, new PostTransformer());
        }
        return ($item) ? collect_recursive($item) : false;
    }

    public function getPostsLimit($category_id = null, $type = null, $limit = 5, $hot = true, $id = 0)
    {
        $modal = Post::where('pos_active', 1);

        if ($category_id) {
            $modal = $modal->where('pos_category_id',$category_id);
        }

        if ($type) {
            $modal = $modal->where('pos_type','=',$type);
        }

        if ($hot) {
            $modal = $modal->where('pos_is_hot','=',1);
        }

        if ($id) {
            $modal = $modal->where('pos_id','<>',$id);
        }

        $items = $modal->limit($limit)
            ->orderBy('pos_total_view', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($items) {
            $items = transformer_collection($items, new PostTransformer());
        }
        return ($items) ? collect_recursive($items) : false;
    }

    public function visited($id)
    {
        Post::where('pos_id', $id)
            ->update([
                'pos_total_view' => DB::raw('pos_total_view + 1')
            ]);
    }
}