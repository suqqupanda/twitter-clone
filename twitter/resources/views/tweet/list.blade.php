@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tweet List</h1>
        
        <ul class="list-group">
            @forelse($tweets as $tweet)
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
            @empty
                <li class="list-group-item">No tweets available.</li>
            @endforelse
        </ul>

        {{ $tweets->links() }}
    </div>
@endsection