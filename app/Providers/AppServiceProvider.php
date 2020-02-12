<?php

namespace App\Providers;

use App\Http\Containers\Example;
use App\Http\Containers\Example4;

use App\Http\Containers\Example5;
use App\Http\Containers\Collaborator;
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
        app()->bind(Example4::class, function() {
            $collborator = new Collaborator;
            $extra = 'This can be moved inside controller just like any other logic can be moved to controller from these route closure';
            return new Example4($collborator, $extra);
        });

        app()->singleton(Example5::class, function() {
            $collborator = new Collaborator;
            $extra = 'This can be moved inside controller just like any other logic can be moved to controller from these route closure';
            return new Example4($collborator, $extra);
        });

        $this->app->bind('example', function(){
            return new Example();
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
