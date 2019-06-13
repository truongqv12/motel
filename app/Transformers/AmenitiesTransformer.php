<?php
/**
 * Created by PhpStorm.
 * User: Minh Vu
 * Date: 30/10/2018
 * Time: 16:39
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class AmenitiesTransformer extends TransformerAbstract
{

    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        $item = [
            'id' => (int)$item->id,
            'name' => $item->name,
        ];

        return $item;
    }
}