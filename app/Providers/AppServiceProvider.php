<?php

namespace App\Providers;

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
        $this->functionHelper();
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
    protected function functionHelper(){
        foreach(glob(__DIR__.'/../FunctionHelper/*.php') as $namafile){
            require_once $namafile;
        }
    }
}
