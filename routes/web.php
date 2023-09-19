<?php

use App\Http\Controllers\taskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('tasks.welcome');
});

Route::get('/tasks',[taskController::class,'index'])->name('tasks.index');

Route::get('/add_tasks',[taskController::class,'addingTask'])->name('addTask');

Route::post('/tasks',[taskController::class,'store'])->name('tasks.store');

Route::delete('/tasks/{id}',[taskController::class,'delete'])->name('tasks.delete');

Route::get('/EditTask/{id}',[taskController::class,'edit'])->name('tasks.edit');

Route::put('/tasks/{id}', [taskController::class, 'update'])->name('tasks.update');

Route::get('/tasks/sort/{order}', [taskController::class, 'sort'])->name('tasks.sort');

Route::get('/tasks/filter/{title}', [taskController::class, 'filter'])->name('tasks.filter');

