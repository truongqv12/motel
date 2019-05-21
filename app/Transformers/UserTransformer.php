<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2/24/19
 * Time: 23:06
 */

namespace App\Transformers;


use App\Models\Users\Users;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{


    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        return [
            'id'      => (int)$item->id,
            'name'    => $item->name,
            'email'   => $item->email,
            'phone'   => $item->phone,
            'avatar'  => $item->avatar,
            'address' => $item->address,
            'active'  => $item->active
        ];
    }
}