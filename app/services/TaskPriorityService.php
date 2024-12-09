<?php

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
        $currentDate = now()->startOfDay();
        $deadline = \Carbon\Carbon::parse($task->deadline)->startOfDay();

        $diffInDays = $currentDate->diffInDays($deadline);

        if ($diffInDays <= 3) {
            $this->setPriority($task, 'high');
        } elseif ($diffInDays > 3 && $diffInDays <= 15) {
            $this->setPriority($task, 'medium');
        } else {
            $this->setPriority($task, 'low');
        }
        return $task;
    }
}
