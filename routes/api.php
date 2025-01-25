<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;


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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('logout', [AuthController::class, 'logout']);
  Route::get('me', [AuthController::class, 'me']);
  Route::resource('tasks', TaskController::class);
  Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus']);
});
