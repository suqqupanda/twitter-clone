<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
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
        'reply',
    ];

    /**
     * ツイートとリプライのリレーション
     *
     * @return BelongsTo
     */
    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class);
    }

    /**
     * ユーザーとのリレーション
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リプライを保存
     *
     * @param string $reply
     * @param integer $tweetId
     * @return void
     */
    public function store(string $reply, int $tweetId): void
    {
        $this->create([
            'user_id' => Auth::id(),
            'tweet_id' => $tweetId,
            'reply' => $reply,
        ]);
    }
}
