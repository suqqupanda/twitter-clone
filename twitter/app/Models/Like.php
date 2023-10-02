<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tweet_id',
    ];

    /**
     * 投稿をいいね
     *
     * @param integer $tweetId
     * @return void
     */
    public function store(int $tweetId): void
    {
        $this->create([
            'user_id' => Auth::id(),
            'tweet_id' => $tweetId,
        ]);
    }

    /**
     * いいねを解除
     *
     * @param integer $tweetId
     * @return void
     */
    public function deleteLike(int $tweetId): void
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('tweet_id', $tweetId)
                    ->first();
        
        if ($like)
        {
            $like->delete();
        }
    }

    /**
     * いいねの数を数える
     *
     * @param integer $tweetId
     * @return int
     */
    public function likeCount(int $tweetId): int
    {
        return $this->where('tweet_id', $tweetId)->count();
    }
}
