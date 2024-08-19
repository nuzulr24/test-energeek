<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('category', [HomeController::class, 'getAllCategory'])->name('api.category.list');
Route::post('add-todo', [HomeController::class, 'store'])->name('api.todo.add');
Route::get('todo', [HomeController::class, 'getAllTodo'])->name('api.todo.list');
Route::get('todo/{id}/delete', [HomeController::class, 'delete'])->name('api.todo.delete');
