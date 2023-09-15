<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class Follower extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass asiignable.
     *
     * @var array<int>
     */
    protected $fillable = [
        'following_id',
        'follower_id',
    ];

    /**
     * ユーザーをフォロー（自分のidとフォロワーのidをデータベースに保存）
     *
     * @param integer $followerId
     * @return void
     */
    public function store(int $followerId): void
    {
        $this->create([
            'following_id' => Auth::id(),
            'follower_id' => $followerId,
        ]);
    }

    /**
     * ユーザーのフォローを解除（保存したidを削除）
     *
     * @param integer $followerId
     * @return void
     */
    public function deleteFollow(int $followerId): void
    {
        $follower = Follower::where('following_id', Auth::id())
                            ->where('follower_id', $followerId)
                            ->first();

        if ($follower)
        {
            $follower->delete();
        }
    }
}