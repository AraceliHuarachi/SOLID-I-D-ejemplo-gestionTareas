<?php

namespace App\Http\Controllers;

use App\Interfaces\TaskManagementInterface;
use App\Interfaces\TaskPriorityInterface;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskManagementInterface $taskManager;
    private TaskPriorityInterface $taskPriority;

    public function __construct(TaskManagementInterface $taskManager, TaskPriorityInterface $taskPriority)
    {
        $this->taskManager = $taskManager;
        $this->taskPriority = $taskPriority;
    }

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|string|in:low,medium,high',
            'status' => 'required|string|in:pending,in_progress,completed',
        ]);
        $task = $this->taskManager->createTask($validated);

        $this->taskPriority->setPriority($task, $validated['priority']);

        return redirect()->route('tasks.index')->with('success', 'task created successfully.');
    }
}
