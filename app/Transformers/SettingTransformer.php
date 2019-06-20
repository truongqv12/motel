<?php
/**
 * Created by PhpStorm.
 * User: Minh Vu
 * Date: 30/10/2018
 * Time: 16:39
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class SettingTransformer extends TransformerAbstract
{

    public function transform($item)
    {
        if (!$item) {
            return [];
        }

        if ($item->type === 'image') {
            $data = [
                'id'    => (int)$item->id,
                'key'   => $item->key,
                'type'  => $item->type,
                'value' => route('index') . '/upload/files/' . $item->value
            ];
        } else {
            $data = [
                'id'    => (int)$item->id,
                'key'   => $item->key,
                'type'  => $item->type,
                'value' => trim($item->value)
            ];
        }

        return $data;
    }
}