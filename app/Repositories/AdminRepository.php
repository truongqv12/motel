<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;

use App\Models\AdminUser;
use App\Transformers\AdminTransformer;


class AdminRepository implements AdminInterface
{

    public function allNotMe()
    {
        $admins = AdminUser::where('id', '<>', auth('admin')->user()->id)->get();
        $result = transformer_collection($admins, new AdminTransformer());
        return $result ? collect_recursive($result) : false;
    }

    public function findById($id)
    {
        $admin = AdminUser::findOrFail($id);
        $result = transformer_item($admin, new AdminTransformer());
        return $result ? collect_recursive($result) : false;
    }

    public function createAdmin($rq)
    {
        $admin = AdminUser::create($rq->all());
        return isset($admin) ? true : false;
    }

    public function updateAdmin($rq, $id)
    {

        $admin = AdminUser::findOrFail($id);
        $check = $admin->update($rq->all());
        return isset($check) ? true : false;
    }

    public function deleteAdmin($id)
    {
        $admin = AdminUser::findOrFail($id);
        $check = $admin->delete();
        return isset($check) ? true : false;
    }
}