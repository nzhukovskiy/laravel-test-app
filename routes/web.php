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
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/login', [UserController::class, 'makeLogin']);
Route::post('/register', [UserController::class, 'makeRegister']);
Route::post('/logout', [UserController::class, 'logout'])->name("logout");
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::resource('articles', ArticleController::class);