@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tweet Detail</h1>
    <p><strong>ユーザー名:</strong> {{ $tweet->user->name }}</p>
    <p><strong>ツイートした日付:</strong> {{ $tweet->created_at->format('Y-m-d H:i:s') }}</p>
    <p><strong>ツイート内容:</strong> {{ $tweet->tweet }}</p>
    <div>
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
    </div>

    @if ($tweet->user->id === Auth::id())
        <a href="{{ route('tweet.edit', ['id' => $tweet->id]) }}" class="btn btn-primary my-1">Update Tweet</a>
        <form action="{{ route('tweet.delete', ['id' => $tweet->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger my-1">Delete Tweet</button>
        </form>
    @endif

    <form action="{{ route('reply.create', ['id' => $tweet->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">リプライを追加</label>
                <textarea name="reply" id="body" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">リプライする</button>
    </form>

    <div class="mt-4">
    <h3>リプライ</h3>
    <!-- リプライする際にバリデーションを通らなかった場合 -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if ($tweet->replies->count() > 0)
        @foreach($tweet->replies as $reply)
            <div>
                <strong>{{ $reply->user->name }}</strong>:
                {{ $reply->reply }}
                <br></br>

                <!-- リプライの持ち主であれば -->
                @if ($reply->user->id === Auth::id())
                <a href="{{ route('reply.edit', ['id' => $reply->id]) }}" class="btn btn-primary">Update Reply</a>
                <form action="{{ route('reply.delete', ['id' => $reply->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger my-1">Delete Reply</button>
                </form>
                @endif
            </div>
        @endforeach
    @else
        <p>まだリプライはありません。</p>
    @endif
    </div>
@endsection