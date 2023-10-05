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

    /**
     * 特定のリプライを取得
     *
     * @param integer $replyId
     * @return Reply|null
     */
    public function getReplyById(int $replyId): Reply|null
    {
        return Reply::find($replyId);
    }

    /**
     * リプライを更新
     *
     * @param integer $replyId
     * @param string $replyText
     * @return void
     */
    public function updateReply(int $replyId, string $replyText): void
    {
        // 更新する特定のリプライを取得
        $reply = $this->getReplyById($replyId);

        // リプライが存在しない場合
        if (is_null($reply)) 
        {
            return redirect(route('tweet.list'))->with('error', 'Reply not found');
        }

        $reply->reply = $replyText;

        $reply->update();
    }

    /**
     * リプライを削除
     *
     * @param integer $replyId
     * @return void
     */
    public function deleteReply(int $replyId): void
    {
        // 削除する特定のリプライを取得
        $reply = $this->getReplyById($replyId);

        $reply->delete();
    }

}
