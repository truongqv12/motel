<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 20/03/2019
 * Time: 11:15 SA
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'childs'
    ];

    public function transform($item)
    {
        return [
            'id'        => (int)$item->cat_id,
            'name'      => $item->cat_name,
            'rewrite'   => $item->cat_rewrite,
            'parent_id' => $item->cat_parent_id,
            'url'       => route('motel.list', ['rewrite' => $item->cat_rewrite]),
            'type'      => $item->cat_type,
            'active'    => $item->cat_active,
            'seo'       => [
                'title'       => $item->cat_seo_title,
                'keywords'    => $item->cat_seo_keyword,
                'description' => $item->cat_seo_description
            ],
        ];
    }

    public function includeChilds($item)
    {
        $item->childs = $item->childs ?? [];
        return $this->collection($item->childs, new static());
    }
}