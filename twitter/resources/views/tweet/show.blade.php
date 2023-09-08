@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tweet Detail</h1>
    <p><strong>ユーザー名:</strong> {{ $tweet->user->name }}</p>
    <p><strong>ツイートした日付:</strong> {{ $tweet->created_at->format('Y-m-d H:i:s') }}</p>
    <p><strong>ツイート内容:</strong> {{ $tweet->tweet }}</p>
    <a href="{{ route('tweet.edit', ['id' => $tweet->id]) }}" class="btn btn-primary">編集</a>
</div>
@endsection