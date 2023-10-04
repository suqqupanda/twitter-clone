<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    <!-- 新規登録画面でのヘッダー -->
                    @if (Route::currentRouteName() === 'signup')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                    <!-- ログイン画面でのヘッダー -->
                    @elseif (Route::currentRouteName() === 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signup') }}">{{ __('Signup') }}</a>
                        </li>
                    @endif

                @else
                    <li class="nav-item dropdown">
                            @auth
                                @switch(Route::currentRouteName())
                                    @case('home')
                                    @case('mypage.edit')
                                    <!-- home画面でのヘッダー -->
                                    <!-- マイページ編集画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['mypageEdit' => true]])
                                        @break

                                    @case('users')
                                    <!-- ユーザー一覧でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['userlist' => true]])
                                        @break

                                    @case('mypage')
                                    <!-- マイページでのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['mypage' => true]])
                                        @break

                                    @case('tweet')
                                    <!-- ツイート画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['tweet' => true]])
                                        @break

                                    @case('tweet.list')
                                    <!-- ツイート一覧画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['tweetlist' => true]])
                                        @break

                                    @case('tweet.show')
                                    @case('tweet.edit')
                                    @case('tweet.delete')
                                    <!-- ツイート詳細画面でのヘッダー -->
                                    <!-- ツイート編集画面でのヘッダー -->
                                    <!-- ツイート削除画面でのヘッダー -->
                                    <!-- ツイート編集のボタンを追加する -->
                                        @include('components.header_elements', ['headerInvisibleElements' => []])
                                        @break

                                    @case('follow.followlist')
                                    <!-- フォロー一覧画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['followlist' => true]])
                                        @break

                                    @case('follow.followerlist')
                                    <!-- フォロワー一覧画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['followerlist' => true]])
                                        @break

                                    @case('tweet.searchclear')
                                    <!-- ツイート検索画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['tweetsearch' => true]])
                                        @break

                                        @case('likelist')
                                    <!-- いいね一覧画面でのヘッダー -->
                                        @include('components.header_elements', ['headerInvisibleElements' => ['likelist' => true]])
                                        @break

                                @endswitch
                            @endauth

                        <!-- 共通で表示するヘッダー -->
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
