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

    public function autoAssignPriority(Task $task): Task
    {
        $currentDate = now();
        $deadline = $task->deadline;

        if ($deadline && $deadline->diffInDays($currentDate) <= 3) {
            $this->setPriority($task, 'high');
        } elseif ($deadline && $deadline->diffInDays($currentDate) <= 7) {
            $this->setPriority($task, 'medium');
        } else {
            $this->setPriority($task, 'low');
        }

        return $task;
    }
}
