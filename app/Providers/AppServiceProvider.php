<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\EmailConfig;
use App\Helper\GetApi;

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
     $this->app->bind('GetApi',function (){
            return new GetApi();
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
