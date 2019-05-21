<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 20/03/2019
 * Time: 11:15 SA
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{
    public function transform($item)
    {
        return [
            'id' => (int)$item->id,
            'loginname' => $item->loginname,
            'name' => $item->name,
            'email' => $item->email,
            'add' => $item->add,
            'edit' => $item->edit,
            'delete' => $item->delete,
        ];
    }
}