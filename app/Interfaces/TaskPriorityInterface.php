<?php

namespace App\Interfaces;

use App\Models\Task;

interface TaskPriorityInterface
{
    public function setPriority(Task $task, string $priority): Task;
}
