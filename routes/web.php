<?php

use App\Http\Middleware\JWTAuthenticateViaCookie;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    return redirect()->intended('/login');
});

Route::get('/login', function () {
    return view('welcome');
})->name('login');
Route::middleware(JWTAuthenticateViaCookie::class)->get('/home', function ( Request $request ) {
    return view('home');
})->name('home');
