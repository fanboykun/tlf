<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\PostController;
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

Route::post('login', [ApiAuthController::class, 'login']);
Route::get('/post/only/get', [BlogPostController::class, 'index']);
Route::group(['middleware' => 'auth:api'], function () : void {
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::post('me', [ApiAuthController::class, 'me']);

    Route::get('/post/auth/get', [BlogPostController::class, 'index']);
});

