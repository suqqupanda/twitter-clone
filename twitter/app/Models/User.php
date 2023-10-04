<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 日付をcarbon形式に変換
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * ユーザーがフォローしているユーザーの一覧を取得（follower_idは自分がフォローした人のid）
     *
     * @return BelongsToMany
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    /**
     * ユーザーをフォローしている他のユーザーの一覧を取得
     *
     * @return BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    /**
     * ツイートをいいねしているユーザーの一覧を取得
     * @return BelongsToMany
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'likes', 'user_id', 'tweet_id');
    }

    /**
     * 新規登録
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * 
     * @return User
     */
    public function register(
        string $name,
        string $email,
        string $password
    ): User
    {
        return $this->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    /**
     * ユーザー一覧を表示
     * 
     * @return Illuminate\Database\Eloquent\Collection 
     */
    public function getAllUsers()
    {
        return $this->orderBy("created_at", "desc")->paginate(config('constant.ITEM_PER_PAGE'));
    }

    /**
     * ログインしているユーザーの情報を取得
     * 
     * @return \App\Models\User|null Userモデルのインスタンスもしくはnull
     */
    public function getLoginUser(): User|null
    {
        return Auth::user(); 
    }

    /**
     * マイページの情報編集
     *
     * @param Request $request
     * @return void
     */
    public function updateUser(Request $request): void
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update();
    }

    /**
     * マイページの情報削除
     *
     * @param integer $userId
     * @return void
     */
    public function deleteUser(int $userId): void
    {
        // ユーザーテーブルから指定したIDの情報を取得
        $user = User::find($userId);
        
        $user->delete();
    }
}
