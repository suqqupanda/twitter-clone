@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tweet List</h1>
        
        <ul class="list-group">
            <!-- 画面で、各ツイートの情報を出力する
            → ツイートしたユーザー名 & ツイート内容 & ツイート日時

            tweetsテーブルとusersテーブルを繋げる（リレーションを張る）
            tweetsテーブルのuser_idとusersテーブルのidが繋げられる -->

            @forelse($tweets as $tweet)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>{{ $tweet->user->name }}</strong> tweeted:
                            <!-- <strong>{{ $tweet->user_id }}</strong> tweeted: -->
                            {{ $tweet->tweet }}
                        </div>
                        <div>
                            {{ $tweet->created_at->diffForHumans() }}
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No tweets available.</li>
            @endforelse
        </ul>

        {{ $tweets->links() }}
    </div>
@endsection