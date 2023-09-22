@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Follower List</title>
</head>
<body>
    <h1>Follower List</h1>
    <ul>
        @foreach ($followers as $follower)
            <div class="d-flex align-items-center my-4">
            <li>{{ $follower->name }}</li>
            </div>
        @endforeach
    </ul>
</body>
</html>
@endsection