<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\User;

class UserRepository implements UserInterface
{
    public function all()
    {
        $users = User::orderBy('id', 'desc')->get();
        return (isset($users)) ? $users : false;
    }

    public function findById($id)
    {
        $user = User::findOrFail($id);
        return (isset($user)) ? $user : false;
    }
}
