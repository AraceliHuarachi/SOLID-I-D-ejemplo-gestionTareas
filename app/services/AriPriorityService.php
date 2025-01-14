<?php

namespace App\Services;

use App\Interfaces\TaskPriorityInterface;
use App\Models\Task;

class AriPriorityService implements TaskPriorityInterface
{
    // Manual priority assignment for a task.
    public function setPriority(Task $task, string $priority): Task
    {
        $task->priority = $priority;
        $task->save();
        return $task;
    }

    // Automatic priority assignment for a task.
    public function autoAssignPriority(Task $task): Task
    {
        $currentDate = now()->startOfDay();
        $deadline = \Carbon\Carbon::parse($task->deadline)->startOfDay();

        // Calculate the difference in days between the task's creation date and the deadline.
        $diffInDays = $currentDate->diffInDays($deadline);

        // Define the range of days for priority levels:
        $daysUrgent = 2; // Two days or less to deliver
        $daysHigh = 7; // One week or less to deliver
        $daysMedium = 30; // One month or less to deliver
        $daysLow = 90; // Three months or less to deliver
        $daysVeryLow = 365; // One year or less to deliver 

        if ($diffInDays <= $daysUrgent) {
            $this->setPriority($task, 'urgent');
        } elseif ($diffInDays <= $daysHigh) {
            $this->setPriority($task, 'high');
        } elseif ($diffInDays <= $daysMedium) {
            $this->setPriority($task, 'medium');
        } elseif ($diffInDays <= $daysLow) {
            $this->setPriority($task, 'low');
        } elseif ($diffInDays <= $daysVeryLow) {
            $this->setPriority($task, 'veryLow');
        }

        return $task;
    }
}
