<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
    public function store(string $tweet): void
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
     * @param string $tweetText
     * @param integer $tweetId
     * @return void
     */
    public function updateTweet(string $tweetText, int $tweetId): void
    {
        // メソッドを呼び出して結果を取得
        $tweet = $this->getTweetById($tweetId);

        $tweet->tweet = $tweetText;

        $tweet->update();
    }

    /**
     * ツイートを削除
     *
     * @param integer $tweetId
     * @return void
     */
    public function deleteTweet(int $tweetId): void
    {
        // 指定したIDのツイートを取得
        $tweet = $this->getTweetById($tweetId);

        $tweet->delete();
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function searchTweet(Request $request): LengthAwarePaginator
    {
        // ツイート一覧をページネートで取得
        $tweets = Tweet::paginate(20);

        // 検索フォームで入力された値を取得する
        $search = $request->input('search');

        // クエリビルダ
        $query = Tweet::query();

        // もし検索フォームにキーワードが入力されたら
        if ($search)
        {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にする
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            // 単語をループで回し、ツイートと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value)
            {
                $query->where('tweet', 'like', '%'.$value.'%');
            }

            // 上記で取得した$queryをページネートにして変数$tweetsに代入
            $tweets = $query->paginate(20);
        }

        return $tweets;
    }
}
