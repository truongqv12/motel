<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 20/03/2019
 * Time: 11:15 SA
 */

namespace App\Transformers;


use Illuminate\Support\Arr;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{

    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        return [
            'id'          => (int)$item->pos_id,
            'title'       => $item->pos_title,
            'rewrite'     => $item->pos_rewrite,
            'image'       => (preg_match('/http/', $item->pos_image)) ? $item->pos_image : route('index') . '/upload/photos/' . $item->pos_image,
            'teaser'      => nl2br($item->pos_teaser),
            'content'     => html_entity_decode($item->pos_content),
            'active'      => $item->pos_active,
            'is_hot'      => $item->pos_is_hot,
            'category_id' => $item->pos_category_id,
            'total_view'  => $item->pos_total_view,
            'created_at'  => new \DateTime($item->created_at),
            'url'         => route('news.detail', ['rewrite' => $item->pos_rewrite]),

            'seo' => [
                'title'       => $item->cat_seo_title,
                'keywords'    => $item->cat_seo_keyword,
                'description' => $item->cat_seo_description
            ],
        ];
    }
}