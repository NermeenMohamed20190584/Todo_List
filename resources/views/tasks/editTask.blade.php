<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container text-center">
        <h1 class="mt-4">Edit Task</h1>

        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('tasks.update', $taskToEdit['id']) }}" class="mt-3">
            @csrf
            @method('PUT') 
            <div class="form-group mx-auto" style="max-width: 30%;">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $taskToEdit['title'] }}" required>
            </div>
      

            <div class="button-container mt-3">
                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
