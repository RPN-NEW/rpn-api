<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::delete('/article/{id}', [AdminController::class, 'delete']);
Route::put('/article/{id}', [AdminController::class, 'update']);
Route::post('/article', [AdminController::class, 'create']);
Route::get('/article', [AdminController::class, 'getAll']);
