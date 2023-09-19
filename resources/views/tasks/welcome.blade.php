<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to To-Do List Manager</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Welcome to the best to-do list</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary mt-3">Get Started</a>
        </div>
    </div>

 
</body>
</html>
