<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get all data from menu.json file
        $menuListJson=file_get_contents(base_path('resources/json/template-list.json'));
        $menuListData= json_decode($menuListJson);

        // share all menuData to all the views
        \View::share('menuData',[$menuListData]);
    }
}
