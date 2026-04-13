<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */


public function boot()
{
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    
    view()->composer(['admin.navigation.adminNavTop','dev.includes.taskMenu'],
    function($view) {
        $view
        ->with('adminInfo',\App\models\admin\adminTable::adminInfo());
    });
}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
