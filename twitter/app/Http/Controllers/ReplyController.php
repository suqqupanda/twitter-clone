<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Http\Requests\ReplyRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * リプライを作成
     *
     * @param Request $request
     * @param integer $tweetId
     * @return void
     */
    public function createReply(ReplyRequest $request, int $tweetId)
    {
        $reply = new Reply();

        $tweet = new Tweet();

        // ツイートが存在しない場合
        if (is_null($tweet->getTweetById($tweetId)))
        {
            return redirect(route('tweet.list'))->with('error', 'Tweet not found');
        }

        $reply->store($request->get('reply'), $tweetId);

        return redirect(route('tweet.show', ['id' => $tweetId]));
    }
}
