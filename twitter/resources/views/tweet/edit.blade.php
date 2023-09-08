@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Tweet</h1>

        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        
        <form method="POST" action="{{ route('tweet.update', ['id' => $tweet->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <p><strong>ユーザー名:</strong> {{ $tweet->user->name }}</p>
                <p><strong>ツイートした日付:</strong> {{ $tweet->created_at->format('Y-m-d H:i:s') }}</p>
                <label for="tweet">Tweet Content</label>
                <textarea id="tweet" name="tweet" class="form-control" rows="4" required>{{ $tweet->tweet }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Tweet</button>
        </form>
    </div>
@endsection