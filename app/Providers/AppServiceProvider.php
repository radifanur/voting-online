<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        config(['app.locale' => 'id']);
	    Carbon::setlocale('id');

        Paginator::useBootstrap();

        Gate::define('admin', function(User $user){
            return $user->roles_id == '1';
        });

        Gate::define('panitia', function(User $user){
            return $user->roles_id != '3';
        });

        Gate::define('pemilih', function(User $user){
            return $user->roles_id == '3';
        });
    }
}
