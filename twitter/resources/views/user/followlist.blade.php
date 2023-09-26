@extends('layouts.app')

@section('title')
    Follow List
@endsection

@section('content')
    <h1>Follow List</h1>
    <ul>
        @foreach ($follows as $follow)
            <div class="d-flex align-items-center my-4">
            <li>{{ $follow->name }}</li>
            </div>
        @endforeach
    </ul>
@endsection