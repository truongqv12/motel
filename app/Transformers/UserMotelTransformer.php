<?php
/**
 * Created by PhpStorm.
 * User: Minh Vu
 * Date: 30/10/2018
 * Time: 16:39
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class UserMotelTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['motel'];

    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        $item = [
            'id'   => (int)$item->id,
            'user_id' => $item->user_id,
        ];

        return $item;
    }

    public function includeMotel($item)
    {
        $motel = $item->motel ?: [];
        return $this->item($motel, new MotelRoomTransformer());
    }
}