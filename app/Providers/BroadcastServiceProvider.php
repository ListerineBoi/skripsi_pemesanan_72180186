<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes(['middleware' => ['web']]);
        Broadcast::routes(['middleware' => ['web','auth:admin']]);
        //Broadcast::routes(['middleware' => ['auth:web,admin']]);

        require base_path('routes/channels.php');
        
    }
}
