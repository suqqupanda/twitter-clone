<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        return self::all();
    }

    /**
     * ユーザーのマイページを表示
     * 
     * @return \App\Models\User|null Userモデルのインスタンスもしくはnull
     */
    public function showMypage()
    {
        return Auth::user();
    }
}


