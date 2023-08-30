<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->orderBy("created_at", "desc")->paginate(10);
        
    }

    /**
     * usersテーブルとtweetsテーブルのリレーションを貼る
     *
     * @return void
     */
    public function user()
    {
        // return $this->hasMany(Tweet::class);
        return $this->belongsTo(User::class);
    }
}
