<?php

namespace App\Providers;

use App\Interfaces\TaskManagementInterface;
use App\Interfaces\TaskPriorityInterface;
use App\Services\AriPriorityService;
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
        // Vincular la interfaz de TaskManagementInterface con TaskManagerService (el servicio que la implementa).
        $this->app->bind(TaskManagementInterface::class, TaskManagerService::class);

        // Obtener la clase de servicio de Priority desde el archivo .env
        $priorityService = env('TASK_PRIORITY_SERVICE', AriPriorityService::class);

        // Vincular la interfaz de TaskPriorityInterface con el servicio definido en .env
        $this->app->bind(TaskPriorityInterface::class, function ($app) use ($priorityService) {
            return new $priorityService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
