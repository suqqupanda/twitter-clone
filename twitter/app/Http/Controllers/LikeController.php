<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Tweet;
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
        $like->deleteLike($tweetId);

        return redirect(route('tweet.show', ['id' => $tweetId]));
    }
}
