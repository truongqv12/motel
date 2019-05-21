<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface CategoryInterface
{
    public function backendAllByType($type = 'POST');

    public function allNotMyChild($id);

    public function findById($id);

    public function all();

    public function getByRewrite($rewrite);

    public function allByType($type = 'MOTEL');

    public function createCategory($rq);

    public function updateCategory($rq, $id);

}