@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tweet Detail</h1>
    <p><strong>ユーザー名:</strong> {{ $tweet->user->name }}</p>
    <p><strong>ツイートした日付:</strong> {{ $tweet->created_at->format('Y-m-d H:i:s') }}</p>
    <p><strong>ツイート内容:</strong> {{ $tweet->tweet }}</p>
    <!-- いいねしている場合 -->
    @if(Auth::user()->likes->contains($tweet->id))
        <form action="{{ route('unlike', ['id' => $tweet->id]) }}" method="POST" class="d-inline-block">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-light rounded-pill mx-4">❤️</button>
        </form>
    <!-- いいねしていない場合 -->
    @else
        <form action="{{ route('like', ['id' => $tweet->id]) }}" method="POST" class="d-inline-block">
            @csrf
            <button type="submit" class="btn btn-light rounded-pill mx-4">🤍</button>
        </form>
    @endif

    <span>{{ $likecount }}</span>

    @if ($tweet->user->id === Auth::id())
        <a href="{{ route('tweet.edit', ['id' => $tweet->id]) }}" class="btn btn-primary">Update Tweet</a>
        <form action="{{ route('tweet.delete', ['id' => $tweet->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Tweet</button>
        </form>
    @endif

    <form action="{{ route('reply', ['id' => $tweet->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">リプライを追加</label>
                <textarea name="reply" id="body" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">リプライする</button>
    </form>

    <div class="mt-4">
    <h3>リプライ</h3>
    @if ($tweet->replies)
        @foreach($tweet->replies as $reply)
            <div>
                <strong>{{ $reply->user->name }}</strong>:
                {{ $reply->reply }}
            </div>
        @endforeach
    @else
        <p>まだリプライはありません。</p>
    @endif</div>
@endsection