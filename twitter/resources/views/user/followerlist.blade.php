@extends('layouts.app')

@section('title')
    Follower List
@endsection

@section('content')
    <h1>Follower List</h1>
    <ul>
        @foreach ($followers as $follower)
            <div class="d-flex align-items-center my-4">
            <li>{{ $follower->name }}</li>
            </div>
        @endforeach
    </ul>
@endsection