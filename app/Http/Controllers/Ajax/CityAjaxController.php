<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityAjaxController extends AjaxController
{
    public function getDistrictByCity(Request $rq)
    {
        $city_id = $rq->city_id;
        $items   = $this->citiesRepository->allDistrict($city_id);
        return view('/ajax/get_district_by_city', compact('items'));
    }
}
