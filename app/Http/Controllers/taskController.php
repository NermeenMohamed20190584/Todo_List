<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class taskController extends Controller
{
    private $jsonPath;
    private $idCounter;

    public function __construct()
    {
        $this->jsonPath = storage_path('app/public/task.json');
        $this->idCounter = $this->getMaxId();
    }

    public function getMaxId()
    {
        $tasks = $this->getDataFromJson();

        if (empty($tasks)) {
            return 0; 
        }
        $maxId = 0;
        foreach ($tasks as $task) {
            if (isset($task['id']) && $task['id'] > $maxId) {
                $maxId = $task['id'];
            }
        }
        return $maxId;
    }
    public function getDataFromJson()
    {
        $tasks = [];


        if (File::exists($this->jsonPath)) {
            $jsonContents = File::get($this->jsonPath);
            $tasks = json_decode($jsonContents, true);
        }

        return $tasks;
    }

    public function storeDataToJson($tasks)
    {

        $jsonContent = json_encode($tasks, JSON_PRETTY_PRINT);

        File::put($this->jsonPath, $jsonContent);
    }
    public function index()
    {
        $tasks = $this->getDataFromJson();
        return view('tasks.showTasks', compact('tasks'));
    }

    public function addingTask()
    {
        return view('tasks.addTask');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100'
        ]);
        try {
            $tasks = $this->getDataFromJson();

            $newTask = [
                'id' => $this->idCounter += 1,
                'title' => $request->input('title'),
                'date_added' => now()->toDateTimeString()
            ];

            $tasks[] = $newTask; 
            $this->storeDataToJson($tasks); 

            return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Failed to add task: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {

        $tasks = $this->getDataFromJson();

  
        $indexToDelete = null;
        foreach ($tasks as $index => $task) {
            if (isset($task['id']) && $task['id'] == $id) {
                $indexToDelete = $index;
                break;
            }
        }

        if ($indexToDelete !== null) {
       
            unset($tasks[$indexToDelete]);

        
            $tasks = array_values($tasks);

            $this->storeDataToJson($tasks);

            return redirect('tasks')->with('success', 'Task deleted successfully.');
        } else {
            return redirect('tasks')->with('error', 'Task not found.');
        }
    }

    public function edit($id)
    {
        
        $tasks = $this->getDataFromJson();

        
        $taskToEdit = null;
        foreach ($tasks as $task) {
            if (isset($task['id']) && $task['id'] == $id) {
                $taskToEdit = $task;
                break;
            }
        }

        if ($taskToEdit) {
            return view('tasks.editTask', compact('taskToEdit'));
        } else {
            return redirect('tasks')->with('error', 'Task not found.');
        }
    }

    public function update(Request $request, $id)
    {
    
        $tasks = $this->getDataFromJson();

      
        $taskToUpdateIndex = null;
        foreach ($tasks as $index => $task) {
            if (isset($task['id']) && $task['id'] == $id) {
                $taskToUpdateIndex = $index;
                break;
            }
        }

        if ($taskToUpdateIndex !== null) {
   
            $tasks[$taskToUpdateIndex]['title'] = $request->input('title');

            
            $this->storeDataToJson($tasks);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
    }

    public function sort($order)
{
    $tasks = $this->getDataFromJson();

    if ($order === 'newest') {

        usort($tasks, function ($a, $b) {
            return strtotime($b['date_added']) - strtotime($a['date_added']);
        });
    } elseif ($order === 'oldest') {
      
        usort($tasks, function ($a, $b) {
            return strtotime($a['date_added']) - strtotime($b['date_added']);
        });
    }

    return view('tasks.showTasks', ['tasks' => $tasks]);
}

public function filter(Request $request)
{
    $searchTerm = $request->input('title'); 

    $tasks = $this->getDataFromJson();

    
    $filteredTasks = array_filter($tasks, function ($task) use ($searchTerm) {

        return stristr($task['title'], $searchTerm);
    });

  
    return view('tasks.filteredTask', ['filteredTasks' => $filteredTasks]);
}


}
