<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\SearchRequest;
use App\Models\Tweet;
use App\Http\Requests\TweetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class TweetController extends Controller
{
    /**
     * ツイート画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('tweet.tweet');
    }

    /**
     * ツイートを登録
     *
     * @param TweetRequest $request
     * @return RedirectResponse
     */
    public function store(TweetRequest $request): RedirectResponse
    {   
        // ツイートモデルインスタンスの作成
        $tweetModel = new Tweet();
        
        // 新規ツイートの登録
        $tweetModel->store($request->tweet);

        return redirect(route('tweet.list'));
    }

    /**
     * ツイート一覧の表示
     *
     * @return View
     */
    public function index(): View
    {
        $tweetModel = new Tweet();

        // ツイート一覧を取得して表示
        $tweets = $tweetModel->getAllTweets();
        
        return view('tweet.list', compact('tweets'));
    }

    /**
     * ツイートの詳細を表示
     *
     * @param integer $tweetId
     * @return View
     */
    public function showTweet(int $tweetId): View
    {
        $tweetModel = new Tweet();

        $tweet = $tweetModel->getTweetById($tweetId);

        $like = new Like();

        $likecount = $like->likeCount($tweetId);

        return view('tweet.show', compact('tweet', 'likecount'));
    }

    /**
     * ツイート編集画面を表示
     *
     * @param integer $tweetId
     * @return View
     */
    public function editTweet(int $tweetId): View
    {
        $tweetModel = new Tweet();

        $tweet = $tweetModel->getTweetById($tweetId);

        return view('tweet.edit', compact('tweet'));
    }

    /**
     * 編集されたツイートを更新
     *
     * @param TweetRequest $request
     * @param integer $tweetId
     * @return RedirectResponse
     */
    public function updateTweet(TweetRequest $request, int $tweetId): RedirectResponse
    {
        // リクエストから必要なデータを抽出
        $tweetText = $request->input('tweet');
        
        $tweetModel = new Tweet();
        
        // ツイートのユーザーIDとログインユーザーのIDを比較
        if (Auth::id() !== $tweetModel->getTweetById($tweetId)->user_id) 
        {
            return redirect(route('tweet.list'))->with('error', 'You do not have permission to update this tweet.');
        }

        $tweetModel->updateTweet($tweetText, $tweetId);
        
        return redirect(route('tweet.list'))->with('success', 'Tweet updated successfully.');
    }

    /**
     * ツイートを削除
     *
     * @param integer $tweetId
     * @return RedirectResponse
     */
    public function deleteTweet(int $tweetId): RedirectResponse
    {
        $tweet = new Tweet();

         // ツイートが存在しない場合
        if (is_null($tweet->getTweetById($tweetId)))
        {
            return redirect(route('tweet.list'))->with('error', 'Tweet not found');
        }

        // ツイートがログインしているユーザーのものではない場合
        if (Auth::id() !== $tweet->user_id)
        {
            return redirect(route('tweet.list'))->with('error', 'You cannot delete tweets from others');
        }

        // ツイートが本人のものである場合
        $tweet->delete();

        return redirect(route('tweet.list'));

    }

    /**
     * 検索ワードが含まれるツイートを検索
     *
     * @param SearchRequest $request
     * @return View
     */
    public function searchTweet(SearchRequest $request): View
    {
        $tweet = new Tweet();

        if ($request->has('search'))
        {
            $tweets = $tweet->searchTweet($request->get('search'));
        }

        return view('tweet.search', compact('tweets'));
    }

    /**
     * 検索クリア
     *
     * @return View
     */
    public function searchClear(): View
    {
        $tweetModel = new Tweet();

        // ツイート一覧を取得して表示
        $tweets = $tweetModel->getAllTweets();
        
        return view('tweet.search', compact('tweets'));
    }
}
