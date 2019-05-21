<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface CitiesInterface
{
    public function allCity();

    public function allDistrict($city_id);

    public function allWard($district_id);
}