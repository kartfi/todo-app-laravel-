<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// When the user opens the site root "/", show the task list.
Route::redirect('/', '/tasks');

// Resource route: creates index, create, store, edit, update, destroy
// for the tasks (the full CRUD operations).
Route::resource('tasks', TaskController::class);

// Extra route to mark a task as completed / pending.
// It uses PATCH and points to the toggle() method.
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])
    ->name('tasks.toggle');
