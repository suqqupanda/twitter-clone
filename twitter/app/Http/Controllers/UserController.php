<?php

// 自分がどこにいるのか
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SampleFormRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  PostRequest  $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(PostRequest $request)
    {   
        dd($request->all());
        // ユーザーモデルインスタンスの作成
        $userModel = new User();
        
        // 新規ユーザーの登録
        $user = $userModel->register(
            $request->name,
            $request->email,
            $request->password
        );

        event(new Registered($user));
        // 登録後そのままログインするようにしている
        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        // URL指定はroute関数を使うと良い
        return redirect(route('home'));
    }


}
