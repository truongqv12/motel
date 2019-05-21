<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Banner;

class BannerRepository implements BannerInterface
{

    public function all()
    {
        $banners = Banner::orderBy('id', 'desc')->get();
        return (isset($banners)) ? $banners : false;
    }

    public function findById($id)
    {
        $banner = Banner::findOrFail($id);
        return (isset($banner)) ? $banner : false;
    }

    public function allActive($limit)
    {
        $banners = Banner::where('active', '=', 1)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();
        return (isset($banners)) ? $banners : false;
    }
}