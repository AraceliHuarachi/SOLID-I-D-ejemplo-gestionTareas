<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Interfaces\TaskManagementInterface;
use App\Interfaces\TaskPriorityInterface;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskManagementInterface $taskManager;
    private TaskPriorityInterface $taskPriority;

    // Inject dependencies for TaskManagement and TaskPriority services
    public function __construct(TaskManagementInterface $taskManager, TaskPriorityInterface $taskPriority)
    {
        $this->taskManager = $taskManager;
        $this->taskPriority = $taskPriority;
    }

    // Get all tasks and return the index view with the tasks
    public function index()
    {
        $tasks = $this->taskManager->getAllTasks();

        return view('tasks.index', compact('tasks'));
    }

    // Return the view for creating a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Create a new task using the task manager service
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        // Use the task manager service
        $task = $this->taskManager->createTask($validated);

        // Automatically assign a priority to the task
        $this->taskPriority->autoAssignPriority($task);

        // Get the assigned priority
        $assignedPriority = $task->priority;

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.')
            ->with('assignedPriority', $assignedPriority);
    }

    // Show the details of a specific task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Return the view to edit a specific task
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        // Update the task with the new data
        $task = $this->taskManager->updateTask($task->id, $validated);

        // Re-assign the priority after updating the task
        $this->taskPriority->autoAssignPriority($task);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete the specified task
    public function destroy(Task $task)
    {
        $this->taskManager->deleteTask($task->id);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
