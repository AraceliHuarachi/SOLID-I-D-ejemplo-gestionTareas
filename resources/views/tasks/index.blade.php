<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
</head>

<body>
    <h1>Task List</h1>

    {{-- Formulario para crear tareas --}}
    <form action="{{ route('tasks.create') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select name="priority" id="priority" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <button type="submit">Create Task</button>
    </form>

    {{-- Lista de tareas --}}
    <ul>
        @foreach ($tasks as $task)
            <li>
                {{ $task->name }} - {{ $task->priority }}
            </li>
        @endforeach
    </ul>
</body>

</html>
