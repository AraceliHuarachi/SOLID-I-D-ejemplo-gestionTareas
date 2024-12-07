<?php

namespace App\Providers;

use App\Interfaces\TaskManagementInterface;
use App\Interfaces\TaskPriorityInterface;
use App\Services\TaskManagerService;
use App\Services\TaskPriorityService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //vincular las interfaces con sus implementaciones para que cuando se necesite una instancia 
        //de la interface, se utilice el servicio que la implementa.
        $this->app->bind(TaskManagementInterface::class, TaskManagerService::class);
        $this->app->bind(TaskPriorityInterface::class, TaskPriorityService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
