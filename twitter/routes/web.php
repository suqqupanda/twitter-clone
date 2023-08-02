<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', [UserController::class, 'create'])
                ->name('signup');

Route::post('/signup', [UserController::class, 'store']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ユーザー一覧を表示
Route::get('/users', [UserController::class, 'index']);