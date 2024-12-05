<?php

// app/Services/TaskPriorityManager.php
namespace App\Services;

use App\Interfaces\TaskPriorityInterface;
use App\Models\Task;

class TaskPriorityService implements TaskPriorityInterface
{
    public function setPriority(Task $task, string $priority): Task
    {
        $task->priority = $priority;
        $task->save();
        return $task;
    }
}
