<?php

namespace App\Interfaces;

use App\Models\Task;

interface TaskManagementInterface
{
    public function createTask(array $data): Task;
    public function updateTask(int $id, array $data): Task;
    public function deleteTask(int $id): bool;
}
