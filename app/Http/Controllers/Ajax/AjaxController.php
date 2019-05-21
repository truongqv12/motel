<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 11/6/18
 * Time: 11:51
 */

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryInterface;
use App\Repositories\CitiesInterface;
use App\Repositories\MotelInterface;


class AjaxController extends Controller
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
        $this->categoryRepository = $categoryRepository;
        $this->motelRepository    = $motelRepository;
        $this->citiesRepository   = $citiesRepository;
    }
}