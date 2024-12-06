<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
</head>

<body>
    <h1>Task List</h1>

    {{-- Botón para ir al formulario de crear tareas --}}
    <a href="{{ route('tasks.create') }}">Create New Task</a>

    {{-- Lista de tareas --}}
    <ul>
        @forelse ($tasks as $task)
            <li>
                <strong>
                    <a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a>
                </strong>
                - Priority: {{ ucfirst($task->priority) }} - Status: {{ ucfirst($task->status) }}
                {{-- Enlace para actualizar la tarea --}}
                <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
            </li>
        @empty
            <p>No tasks available.</p>
        @endforelse
    </ul>
</body>

</html>
