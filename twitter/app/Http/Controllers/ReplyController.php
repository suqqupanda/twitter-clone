<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Http\Requests\ReplyRequest;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ReplyController extends Controller
{
    /**
     * リプライを作成
     *
     * @param ReplyRequest $request
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

    /**
     * リプライ編集画面を表示
     *
     * @param integer $replyId
     * @return View|RedirectResponse
     */
    public function editreply(int $replyId): View|RedirectResponse
    {
        $replyModel = new Reply();

        // replyIdから特定のリプライを取得
        $reply = $replyModel->getReplyById($replyId);

        // リプライが存在しない場合
        if (is_null($reply))
        {
            return redirect(route('tweet.list'))->with('error', 'Reply not found');
        }

        return view('tweet.replyedit', compact('reply'));
    }

    /**
     * リプライを更新
     *
     * @param ReplyRequest $request
     * @param integer $replyId
     * @return RedirectResponse
     */
    public function updateReply(ReplyRequest $request, int $replyId): RedirectResponse
    {
        // リクエストから必要な情報を抽出
        $replyText = $request->input('reply');

        $replyModel = new Reply();
        $reply = $replyModel->getReplyById($replyId);

        // リプライが存在しない場合
        if (is_null($reply))
        {
            return redirect(route('tweet.list'))->with('error', 'Reply not found');
        }

        // リプライのユーザーIDとログインユーザーのIDを比較
        if (Auth::id() !== $reply->user_id) 
        {
            return redirect(route('tweet.list'))->with('error', 'You do not have permission to update this reply.');
        }
        
        $reply->updateReply($replyId, $replyText);

        return redirect(route('tweet.list'));
    }

    /**
     * リプライを削除
     *
     * @param integer $replyId
     * @return RedirectResponse
     */
    public function deleteReply(int $replyId): RedirectResponse
    {
        $replyModel = new Reply();
        $reply = $replyModel->getReplyById($replyId);

        // リプライが存在しない場合
        if (is_null($reply))
        {
            return redirect(route('tweet.list'))->with('error', 'Reply not found');
        }

        // リプライがログインしているユーザーのものではない場合
        if (Auth::id() !== $reply->user_id)
        {
            return redirect(route('tweet.list'))->with('error', 'You cannot delete tweets from others');
        }
        
        $reply->delete();

        return redirect(route('tweet.list'));
    }
}
