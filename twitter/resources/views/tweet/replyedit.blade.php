@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Reply</h1>

        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        
        <form method="POST" action="{{ route('reply.update', ['id' => $reply->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <p><strong>ユーザー名:</strong> {{ $reply->user->name }}</p>
                <p><strong>リプライした日付:</strong> {{ $reply->created_at->format('Y-m-d H:i:s') }}</p>
                <label for="tweet">Reply Content</label>
                <textarea id="tweet" name="reply" class="form-control" rows="4" required>{{ $reply->reply }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Reply</button>
        </form>
    </div>
@endsection