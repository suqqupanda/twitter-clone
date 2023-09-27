@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('tweet.search') }}">
    <input type="search" placeholder="検索ワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
    <div>
        <button type="submit">検索</button>
        <button>
            <a href="{{ route('tweet.search') }}" class="text-white">
                クリア
            </a>
        </button>
    </div>
</form>

@foreach($tweets as $tweet)
    <a href="{{ route('tweet.show', ['id' => $tweet->id]) }}">
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $tweet->user->name }}</strong> tweeted:
                    {{ $tweet->tweet }}
                </div>
                <div>
                    {{ $tweet->created_at->format('Y年m月d日') }}
                </div>
            </div>
        </li>
    </a>
@endforeach
@endsection
