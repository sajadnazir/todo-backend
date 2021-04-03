<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('task-list', [TaskController::class, 'index']);
Route::post('task-add', [TaskController::class, 'store']);
Route::put('task-update/{id}', [TaskController::class, 'update']);
Route::put('task-status/{id}', [TaskController::class, 'changeTaskStatus']);
Route::delete('task-delete/{id}', [TaskController::class, 'destroy']);
