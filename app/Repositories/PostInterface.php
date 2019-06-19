<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:10 CH
 */

namespace App\Repositories;


interface PostInterface
{
    public function allByCatId($cat_id);

    public function getByRewrite($rewrite);

    public function visited($id);

    public function getPostsLimit($category_id = null, $type = null, $limit = 5, $hot = true, $id = 0);
}