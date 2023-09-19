<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adding new task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container text-center">
        <h1 class="mt-4">Add new task</h1>
        <form action="{{ route('tasks.store') }}" method="POST" id="taskForm" class="mt-3">
            @csrf
            <div class="form-group mx-auto" style="max-width: 30%;">
                <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
            </div>
            <div class="button-container mt-3">
                <button type="submit" class="btn btn-primary">Add Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to the Task List</a>
            </div>
        </form>
    </div>
</body>
</html>
