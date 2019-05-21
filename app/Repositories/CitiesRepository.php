<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Cities;
use App\Transformers\CityTransformer;

class CitiesRepository implements CitiesInterface
{

    public function allCity()
    {
        $cities = Cities::where('cit_parent_id', '=', 0)->get();

        $cities = transformer_collection($cities, new CityTransformer(), ['test']);

        return $cities ? collect_recursive($cities) : false;
    }

    public function allDistrict($city_id)
    {
        $districts = Cities::where('cit_parent_id', '=', $city_id)->get();

        $districts = transformer_collection($districts, new CityTransformer());

        return $districts ? collect_recursive($districts) : false;
    }

    public function allWard($district_id)
    {
        $wards = Cities::where('cit_parent_id', '=', $district_id)->get();

        $wards = transformer_collection($wards, new CityTransformer());

        return $wards ? collect_recursive($wards) : false;
    }

}