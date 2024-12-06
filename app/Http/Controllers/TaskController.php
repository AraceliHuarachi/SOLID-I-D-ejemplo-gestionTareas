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

    public function create()
    {
        return view('tasks.create');
    }


    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        $task = $this->taskManager->createTask($validated);

        $this->taskPriority->setPriority($task, $validated['priority']);

        return redirect()->route('tasks.index')->with('success', 'task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        $task->update($validated);

        $this->taskPriority->setPriority($task, $validated['priority']);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}
