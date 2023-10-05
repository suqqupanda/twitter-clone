@extends('layouts.app')

@section('title')
    Like List
@endsection

@section('content')
    <h1>Like List</h1>
    <ul>
        @foreach ($likes as $like)
            <div class="d-flex align-items-center my-4">
            <strong>{{ $like->user->name }}</strong> tweeted:   
            {{ $like->tweet }}
            </div>
        @endforeach
    </ul>
@endsection