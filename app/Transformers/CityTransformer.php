<?php
/**
 * Created by PhpStorm.
 * User: Minh Vu
 * Date: 30/10/2018
 * Time: 16:39
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
{

    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        $item = [
            'id' => (int)$item->cit_id,
            'name' => $item->cit_name,
        ];

        return $item;
    }
}