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
    public function all();

    public function newMotel($limit = 10);

    public function allByCatId($cat_id);

    public function allByUseNeed($use_need = 1);

    public function getByRewrite($rewrite);

    public function getById($id, $admin = false);

    public function search($rq);

    public function allAmenities();

    public function myMotel();

    public function myMotelSave();

    public function visited($id);
}