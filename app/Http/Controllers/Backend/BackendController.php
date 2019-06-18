<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\AdminInterface;
use App\Repositories\BannerInterface;
use App\Repositories\CategoryInterface;
use App\Repositories\UserInterface;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public $adminRepository;
    public $userRepository;
    public $categoryRepository;
    public $bannerRepository;

    public function __construct(
        AdminInterface $adminRepository,
        UserInterface $userRepository,
        CategoryInterface $categoryRepository,
        BannerInterface $bannerRepository
    )
    {
        $this->middleware('auth:admin');
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->bannerRepository = $bannerRepository;
    }
}
