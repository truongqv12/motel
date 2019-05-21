<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface AdminInterface
{
    public function allNotMe();

    public function findById($id);

    public function createAdmin($rq);

    public function updateAdmin($rq, $id);

    public function deleteAdmin($id);
}