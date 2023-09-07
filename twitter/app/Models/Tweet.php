<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Requests\TweetRequest;


class Tweet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tweet',
    ];

    /**
     * ツイートを登録
     *
     * @param string $tweet
     * @return void
     */
    public function store(
        string $tweet,
    ): void
    {
        $this->create([
            'user_id' => Auth::id(),
            'tweet' => $tweet,
        ]);
    }

    /**
     * 全ツイートを取得
     *
     * @return void
     */
    public function getAllTweets()
    {
        return $this->orderBy("created_at", "desc")->paginate(config('constant.ITEM_PER_PAGE'));
    }

    /**
     * usersテーブルとtweetsテーブルのリレーションを貼る
     *
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 特定のツイートの情報を取得
     *
     * @param int $tweetId
     * @return Tweet|null
     */
    public function getTweetById(int $tweetId): Tweet|null
    {
        // ツイートテーブルから指定したIDの情報を取得
        return Tweet::find($tweetId);
    }

    /**
     * ツイートを更新
     *
     * @param TweetRequest $request
     * @param integer $tweetId
     * @return Tweet
     */
    public function updateTweet(string $tweetText, int $tweetId): Tweet
    {
        // クラスのインスタンスを作成
        $instance = new Tweet();

        // メソッドを呼び出して結果を取得
        $tweet = $instance->getTweetById($tweetId);

        $tweet->tweet = $tweetText;

        $tweet->update();

        return $tweet;
    }
}
