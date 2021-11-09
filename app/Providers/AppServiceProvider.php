<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use App\Models\setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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

          if(env('DB_USERNAME')!=NULL){
            if (Schema::hasTable('settings')) {
                    $setings = setting::first();
                    View::share(['settings' =>$setings]);   
                }                            
                Paginator::useBootstrap();
            }

         

        
    }
}
