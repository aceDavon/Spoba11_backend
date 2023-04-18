<?php

use App\Http\Controllers\api\V1\AuthController;
use App\Http\Controllers\api\V1\UsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(["prefix" => "v1", "middleware" => ['auth:sanctum']], function () {
    Route::resource('/users', UsersController::class);
    Route::post('/users/logout', [AuthController::class, 'logout']);
});
