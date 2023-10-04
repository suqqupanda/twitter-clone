<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class LikeController extends Controller
{
    /**
     * いいね
     *
     * @param integer $tweetId
     * @return RedirectResponse
     */
    public function like(int $tweetId): RedirectResponse
    {
        $like = new Like();

        $tweet = new Tweet();

         // ツイートが存在しない場合
        if (is_null($tweet->getTweetById($tweetId)))
        {
            return redirect(route('tweet.list'))->with('error', 'Tweet not found');
        }

        $like->store($tweetId);

        return redirect(route('tweet.show', ['id' => $tweetId]));
    }

    /**
     * いいね解除
     *
     * @param integer $tweetId
     * @return RedirectResponse
     */
    public function unlike(int $tweetId): RedirectResponse
    {
        $like = new Like();

        $tweet = new Tweet();

        // ツイートが存在しない場合
        if (is_null($tweet->getTweetById($tweetId)))
        {
            return redirect(route('tweet.list'))->with('error', 'Tweet not found');
        }

        $like->deleteLike($tweetId);

        return redirect(route('tweet.show', ['id' => $tweetId]));
    }

    // ログインしているユーザーがいいねしている一覧を表示
    public function likelist()
    {
        $likes = Auth::user()->likes;
        return view('tweet.likelist', compact('likes'));
    }
}
