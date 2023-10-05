<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\ReplyController;

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

Route::get('/', function () {return view('welcome');})->name('/');

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
        // マイページを編集画面を表示
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
        // ツイート詳細を表示
        Route::get('/show/{id}', [TweetController::class, 'showTweet'])->name('.show');
        // ツイートの編集画面を表示
        Route::get('/edit/{id}', [TweetController::class, 'editTweet'])->name('.edit');
        // 変更された情報を更新
        Route::put('/update/{id}', [TweetController::class, 'updateTweet'])->name('.update');
        // ツイートを削除
        Route::delete('/delete/{id}', [TweetController::class, 'deleteTweet'])->name('.delete');
        // ツイート検索画面を表示
        Route::get('/search', [TweetController::class, 'searchTweet'])->name('.search');
        // ツイートの検索結果をクリア
        Route::get('/search/clear', [TweetController::class, 'searchClear'])->name('.searchclear');
    });

    Route::group(['prefix' => 'follow', 'as' => 'follow'], function() {
        // ユーザーをフォロー
        Route::post('/{id}', [UserController::class, 'follow'])->name('');
        // フォローを解除
        Route::delete('/delete/{id}', [UserController::class, 'unfollow'])->name('.delete');
        // フォロー一覧を表示
        Route::get('/followed', [UserController::class, 'followlist'])->name('.followlist');
        // フォロワー一覧を表示
        Route::get('/follower', [UserController::class, 'followerlist'])->name('.followerlist');
    });

    // いいね
    Route::post('/like/{id}', [LikeController::class, 'like'])->name('like');
    // いいねを解除
    Route::delete('/unlike/{id}', [LikeController::class, 'unlike'])->name('unlike');
    // いいねの一覧を表示
    Route::get('/likelist', [LikeController::class, 'likelist'])->name('likelist');

    Route::group(['prefix' => 'reply', 'as' => 'reply'], function() {
        // リプライの作成
        Route::post('/{id}', [ReplyController::class, 'create'])->name('');
        // リプライ編集画面の表示
        Route::get('/edit/{id}', [ReplyController::class, 'edit'])->name('.edit');
        // リプライの更新
        Route::put('/update/{id}', [ReplyController::class, 'update'])->name('.update');
        // リプライの削除
        Route::delete('/delete/{id}', [ReplyController::class, 'delete'])->name('.delete');
    });
});