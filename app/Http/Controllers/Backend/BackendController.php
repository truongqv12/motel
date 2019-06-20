<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\AdminInterface;
use App\Repositories\CategoryInterface;
use App\Repositories\MotelInterface;
use App\Repositories\UserInterface;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public $adminRepository;
    public $userRepository;
    public $categoryRepository;
    public $bannerRepository;
    public $motelRepository;

    public function __construct(
        AdminInterface $adminRepository,
        UserInterface $userRepository,
        CategoryInterface $categoryRepository,
        MotelInterface $motelRepository
    )
    {
        $this->middleware('auth:admin');
        $this->adminRepository    = $adminRepository;
        $this->userRepository     = $userRepository;
        $this->motelRepository    = $motelRepository;
        $this->categoryRepository = $categoryRepository;
    }
}
