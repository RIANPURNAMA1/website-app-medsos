<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Database\Connectors\PostgresConnector;
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



Route::get('/register' , [RegisterController::class, 'register'])->middleware('guest');
Route::get('/post/update-setting/{id}', [RegisterController::class, 'setting'])->middleware('auth');
Route::post('/post/update-setting/{id}', [RegisterController::class, 'updatesetting'])->middleware('auth');
Route::post('/register/store' , [RegisterController::class, 'registerStore'])->middleware('guest');
Route::get('/login' , [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::get('/logout' , [LoginController::class, 'logout']);
Route::post('/login/store' , [LoginController::class, 'loginStore'])->middleware('guest');

// post
Route::get('/post', [PostController::class, 'index'])->middleware('auth');
Route::get('/post/search', [PostController::class, 'index'])->middleware('auth');
Route::get('/', [PostController::class, 'beranda'])->middleware('auth');
Route::post('/store', [PostController::class, 'store'])->middleware('auth');
Route::get('/post/lihat/{id}', [PostController::class, 'show'])->middleware('auth');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->middleware('auth');
Route::post('/post/update/{id}', [PostController::class, 'update'])->middleware('auth');
Route::post('/post/hapus/{id}', [PostController::class, 'destroy'])->middleware('auth');


