<?php

// app/Services/TaskManager.php
namespace App\Services;

use App\Interfaces\TaskManagementInterface;
use App\Models\Task;

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
}
