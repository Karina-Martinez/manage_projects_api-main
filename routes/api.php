<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProyectoController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/usuarios', [AuthController::class, 'getUsers']);

    Route::get('/proyectos', [ProyectoController::class, 'index']);
    Route::get('/proyectos/{proyectoId}', [ProyectoController::class, 'getOne']);

    Route::post('/proyectos', [ProyectoController::class, 'storeOne']);
    Route::post('/proyectos-update/{proyectoId}', [ProyectoController::class, 'updateOne']);

    Route::delete('/proyectos/{proyectoId}', [ProyectoController::class, 'deleteOne']);

    Route::get('/tareas', [TareaController::class, 'index']);
    Route::get('/tareas/{tareaId}', [TareaController::class, 'getOne']);

    Route::post('/tareas', [TareaController::class, 'storeOne']);
    Route::post('/tareas-update/{tareaId}', [TareaController::class, 'updateOne']);

    Route::delete('/tareas/{tareaId}', [TareaController::class, 'deleteOne']);
});
