@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tweet Detail</h1>
    <p><strong>ユーザー名:</strong> {{ $tweet->user->name }}</p>
    <p><strong>ツイートした日付:</strong> {{ $tweet->created_at->format('Y-m-d H:i:s') }}</p>
    <p><strong>ツイート内容:</strong> {{ $tweet->tweet }}</p>
    @if ($tweet->user->id === Auth::id())
        <a href="{{ route('tweet.edit', ['id' => $tweet->id]) }}" class="btn btn-primary">Update Tweet</a>
        <form action="{{ route('tweet.delete', ['id' => $tweet->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Tweet</button>
        </form>
    @endif
</div>
@endsection