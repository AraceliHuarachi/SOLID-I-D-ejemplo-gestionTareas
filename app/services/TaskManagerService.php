<?php

// app/Services/TaskManager.php
namespace App\Services;

use App\Interfaces\TaskManagementInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskManagerService implements TaskManagementInterface
{
    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(int $id, array $data): Task
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask(int $id): bool
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }

    //implementacion del metodo de consulta de la interface.
    public function getAllTasks(): Collection
    {
        return Task::orderBy('created_at', 'desc')->get();
    }
}
