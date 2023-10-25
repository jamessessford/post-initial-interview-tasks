<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('edit-complaint', function ($user, $complaint) {
            if (auth()->check() && $complaint->status !== 'under_investigation') {
                return true;
            }
            return $user->isAdmin();
        });
        
        

        Gate::define('create-complaint', function ($user) {
            return $user !== null;
        });

        Gate::define('add-note', function ($user, $complaint) {
            return $user->isStaff() || $user->isAdmin();
        });

        Schema::defaultStringLength(191);
    }
}

