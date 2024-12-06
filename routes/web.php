<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});
Route::resource('tasks', TaskController::class);

// Route::view('tasks/create', 'tasks.create')->name('tasks.create');
// Route::view('tasks/{task}/edit', 'tasks.edit')->name('tasks.edit');
