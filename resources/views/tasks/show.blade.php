<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
</head>

<body>
    <h1>Task Details</h1>

    <p><strong>Name:</strong> {{ $task->name }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>

    {{-- Botón para regresar --}}
    <a href="{{ route('tasks.index') }}">Back to Task List</a>
</body>

</html>
