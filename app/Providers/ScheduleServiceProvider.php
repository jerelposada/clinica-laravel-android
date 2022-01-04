<?php

namespace App\Providers;

use App\interfaces\ScheduleServicesInterface;
use App\Services\ScheduleServices;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScheduleServicesInterface::class,ScheduleServices::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
