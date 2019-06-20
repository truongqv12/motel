<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Banner;
use App\Models\SettingWebsite;
use App\Transformers\SettingTransformer;

class SettingRepository implements SettingInterface
{

    public function all()
    {
        $settings = SettingWebsite::all();
        $settings = $settings->keyBy('key');
        $settings = transformer_collection($settings, new SettingTransformer());
        return $settings ? collect_recursive($settings) : false;
    }
}