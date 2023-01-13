<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ArticleController::class, 'index'])->name("home");
Route::get('/login', [UserController::class, 'show_login'])->name('login');
Route::get('/register', [UserController::class, 'show_register'])->name('register');
Route::post('/login', [UserController::class, 'make_login']);
Route::post('/register', [UserController::class, 'make_register']);
Route::post('/logout', [UserController::class, 'logout'])->name("logout");
Route::get('/profile', [UserController::class, 'show_profile'])->name('profile');
Route::resource('articles', ArticleController::class);