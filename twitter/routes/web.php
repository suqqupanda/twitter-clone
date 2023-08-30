<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetController;

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

// 新規登録ページを表示
Route::get('signup', [UserController::class, 'create'])->name('signup');

// 新規ユーザーを登録
Route::post('signup', [UserController::class, 'store']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ユーザー一覧を表示
Route::get('/users', [UserController::class, 'index'])->name('users');

// 認証済みRoute
Route::group(['middleware' => 'auth'], function () {
    // Mypageグループ
    Route::group(['prefix' => 'mypage', 'as' => 'mypage'], function() {
        // マイページを表示
        Route::get('/', [UserController::class, 'showMypage'])->name('');
        // マイページの編集画面を表示
        Route::get('/edit', [UserController::class, 'editMypage'])->name('.edit');
        // 変更された情報を更新
        Route::put('/update', [UserController::class, 'updateMypage'])->name('.update');
        // ユーザーを削除
        Route::delete('/delete', [UserController::class, 'deleteMypage'])->name('.delete');
    });

    Route::group(['prefix' => 'tweet', 'as' => 'tweet'], function() {
        // ツイート作成画面を表示
        Route::get('/', [TweetController::class, 'create'])->name('');
        // ツイートを作成
        Route::post('/', [TweetController::class, 'store'])->name('.post');
        // ツイート一覧を表示
        Route::get('/list', [TweetController::class, 'index'])->name('.list');
    });
});
