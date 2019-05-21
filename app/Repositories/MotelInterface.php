<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface MotelInterface
{
    public function all($per_page = 20);

    public function newMotel($limit = 10);

    public function allByCatId($cat_id);

    public function getByRewrite($rewrite);

    public function search($rq);
}