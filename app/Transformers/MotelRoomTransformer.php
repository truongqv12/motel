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

class MotelRoomTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'city',
        'district',
        'ward',
        'category',
        'user',
    ];

    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        $images = json_decode($item->images, 1);
        $latlng = json_decode($item->latlng, 1);
        return [
            'id'          => (int)$item->id,
            'title'       => $item->title,
            'slug'        => $item->slug,
            'price'       => format_money($item->price),
            'area'        => (int)$item->area,
            'address'     => trim($item->address),
            'phone'       => $item->phone,
            'people'      => $item->people,
            'toilet'      => $item->toilet,
            'avatar'      => img_motel_link(Arr::first($images)),
            'images'      => $images,
            'amenities'   => json_decode(base64_decode($item->amenities), 1),
            'lat'         => $latlng[0],
            'lng'         => $latlng[1],
            'status'      => $item->status,
            'category_id' => $item->category_id,
            'total_view'  => $item->total_view,
            'description' => html_entity_decode($item->description),
            'created_at'  => new \DateTime($item->created_at),
            'url'         => route('motel.detail', ['cat_id' => $item->category_id, 'rewrite' => $item->slug]),
        ];
    }

    public function includeCity($item)
    {
        $item->city = $item->city ?: [];
        return $this->item($item->city, new CityTransformer());
    }

    public function includeDistrict($item)
    {
        $item->district = $item->district ?: [];
        return $this->item($item->district, new CityTransformer());
    }

    public function includeWard($item)
    {
        $item->ward = $item->ward ?: [];
        return $this->item($item->ward, new CityTransformer());
    }

    public function includeCategory($item)
    {
        $item->category = $item->category ?: [];
        return $this->item($item->category, new CategoryTransformer());
    }

    public function includeUser($item)
    {
        $item->user = $item->user ?: [];
        return $this->item($item->user, new UserTransformer());
    }
}