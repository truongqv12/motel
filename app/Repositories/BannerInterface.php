<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface BannerInterface
{
    public function all();

    public function findById($id);

    public function allActive($limit);
}