<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface ProductInterface
{
    public function all();

    public function findById($id);

//    public function newProduct(array $filters);
}