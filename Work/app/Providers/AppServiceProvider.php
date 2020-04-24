<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Places;
use App\Models\User;
use App\Models\UsersPost;
use App\Observers\GroupObserver;
use App\Observers\PlacesObserver;
use App\Observers\UserObserver;
use App\Observers\UsersPostObserver;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        UsersPost::observe(UsersPostObserver::class);
        Places::observe(PlacesObserver::class);
        Group::observe(GroupObserver::class);
    }
}
