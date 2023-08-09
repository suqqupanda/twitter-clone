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
// use Auth;

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

    public function index()
    {
        $userModel = new User();

        // ユーザー一覧を取得して表示
        $users = $userModel->getAllUsers();
        return view('user.users', ['users' => $users]);
    }

    public function showMypage()
    {
        $userModel = new User();

        // ユーザーの情報を取得して表示
        $user = $userModel->showMypage();
        return view('user.show', ['user' => $user]);
    }

    public function editMypage()
    {
        return view('mypage.edit', ['user' => Auth::user()]);
    }

    public function updateMypage(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // 他に編集可能なフィールドを追加
        ]);

        $user->update($validatedData);

        return redirect()->route('mypage.edit')->with('success', 'Mypage updated successfully.');
    }
}
