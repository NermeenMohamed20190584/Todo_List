<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Tasks</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Filtered Tasks</h1>

        @if(count($filteredTasks) === 0)
        <p>No matching tasks found.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Task Date Added</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filteredTasks as $task)
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
                    
                </tr>

                @endforeach
            </tbody>
        </table>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary" >Back</a>
        @endif
    </div>

 
</body>

</html>
