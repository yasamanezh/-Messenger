<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\EmailConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
     $this->app->bind('EmailConfig',function (){
            return new EmailConfig();
    });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
