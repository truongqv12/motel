<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryInterface;
use App\Repositories\CitiesInterface;
use App\Repositories\MotelInterface;


class FrontEndController extends Controller
{
    public $categoryRepository;
    public $motelRepository;
    public $citiesRepository;

    public function __construct(
        CategoryInterface $categoryRepository,
        MotelInterface $motelRepository,
        CitiesInterface $citiesRepository
    )
    {
        $this->setMeta();
        $this->categoryRepository = $categoryRepository;
        $this->motelRepository    = $motelRepository;
        $this->citiesRepository   = $citiesRepository;
        $this->header();

    }

    public function header()
    {
        $categories = $this->categoryRepository->allByType("MOTEL");
        $cats_post = $this->categoryRepository->allByType("POST");
        \View::share(compact('categories','cats_post'));
    }

    public function setMeta()
    {
        $meta = [
            'title'          => 'Trọ Tốt - SÀN GIAO DỊCH THÔNG TIN NHÀ TRỌ',
            'description'    => 'Sàn giao dịch thông tin nhà trọ.',
            'keywords'       => 'nha tro, phong tro, phong tro gia re, phong tro gia re cho sinh vien',
            'og:title'       => 'TrọTốt.vn - SÀN GIAO DỊCH THÔNG TIN NHÀ TRỌ',
            'og:description' => 'Sàn giao dịch thông tin nhà trọ.',
        ];
        \Meta::set($meta);
    }
}
