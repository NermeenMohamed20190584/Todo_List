<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Manager</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    @if (empty($tasks))
    <div class="container text-center mt-5">
        <h1 class="mb-4">Todo List</h1>
        <p>No tasks available.</p>
        <a href="{{ route('addTask') }}" class="btn btn-success">Add Task</a> 
    </div>
    @else
    <div class="container mt-5">
        <h1 class="mb-4">Todo List</h1>

        
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

  
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ route('tasks.sort', 'newest') }}" class="btn btn-primary">Sort Newest</a>
                <a href="{{ route('tasks.sort', 'oldest') }}" class="btn btn-primary ml-2">Sort Oldest</a>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('tasks.filter', 'SEARCH_TERM') }}" method="GET">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Search by Title">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</div>

        
        <table class="table">
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Task Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (empty($tasks))
                <tr>
                    <td colspan="3">No tasks available.</td>
                </tr>
                @else
                @foreach($tasks as $key => $task)
                <tr>
                    <td>
                        @if(isset($task['title']))
                        {{ $task['title'] }}
                        @else
                        Missing Title
                        @endif
                    </td>
                    <td>
                        @if(isset($task['date_added']))
                        {{ $task['date_added'] }}
                        @else
                        Missing Date
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <form action="{{ route('tasks.delete', ['id' => $task['id']]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mr-2">Delete</button> 
                            </form>
                            <form action="{{ route('tasks.edit', ['id' => $task['id']]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary">Edit</button> 
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    
        <a href="{{ route('addTask') }}" class="btn btn-success">Add Task</a> <!-- Make Add button green -->
    </div>
    @endif

  
</body>

</html>
