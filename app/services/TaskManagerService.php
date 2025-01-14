<?php

namespace App\Services;

use App\Interfaces\TaskManagementInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskManagerService implements TaskManagementInterface
{
    // Create a new task with the provided data
    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    // Update an existing task by its ID with the provided data
    public function updateTask(int $id, array $data): Task
    {
        $task = Task::findOrFail($id); // Find the task by ID or throw an exception
        $task->update($data); // Update the task with the new data
        return $task; // Return the updated task
    }

    // Delete a task by its ID
    public function deleteTask(int $id): bool
    {
        $task = Task::findOrFail($id); // Find the task by ID or throw an exception
        return $task->delete(); // Delete the task and return whether it was successful
    }

    // Get all tasks, ordered by creation date (most recent first)
    public function getAllTasks(): Collection
    {
        return Task::orderBy('created_at', 'desc')->get(); // Return all tasks in descending order of creation date
    }
}
