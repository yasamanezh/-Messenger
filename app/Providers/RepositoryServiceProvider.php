<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contract\iBlog;
use App\Repositories\Elequent\BlogRepository;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(iBlog::class ,BlogRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
