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
        // Bind the TaskManagementInterface to TaskManagerService (the service implementing it)
        $this->app->bind(TaskManagementInterface::class, TaskManagerService::class);

        // Get the priority service class from the .env file
        $priorityService = env('TASK_PRIORITY_SERVICE', AriPriorityService::class);

        // Bind the TaskPriorityInterface to the service defined in .env
        $this->app->bind(TaskPriorityInterface::class, function ($app) use ($priorityService) {
            return new $priorityService();
        });
    }
}
