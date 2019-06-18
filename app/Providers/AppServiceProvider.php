<?php

namespace App\Providers;

use App\Repositories\AdminInterface;
use App\Repositories\AdminRepository;
use App\Repositories\BannerInterface;
use App\Repositories\BannerRepository;
use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CitiesInterface;
use App\Repositories\CitiesRepository;
use App\Repositories\MotelInterface;
use App\Repositories\MotelRepository;
use App\Repositories\PostInterface;
use App\Repositories\PostRepository;
use App\Repositories\UserInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBindingRepository();
    }

    public function registerBindingRepository()
    {
        $this->app->bind(AdminInterface::class, AdminRepository::class);

        $this->app->bind(UserInterface::class, UserRepository::class);

        $this->app->bind(CategoryInterface::class, CategoryRepository::class);

        $this->app->bind(PostInterface::class, PostRepository::class);

        $this->app->bind(BannerInterface::class, BannerRepository::class);

        $this->app->bind(MotelInterface::class, MotelRepository::class);

        $this->app->bind(CitiesInterface::class, CitiesRepository::class);
    }
}
