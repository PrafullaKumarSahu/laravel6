<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Http\Containers\Example4;
use App\Http\Containers\Collaborator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Example4::class, function () {
            $collborator = new Collaborator;
            $extra = 'This can be moved inside controller just like any other logic can be moved to controller from these route closure';
            return new Example4($collborator, $extra);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);
    }
}
