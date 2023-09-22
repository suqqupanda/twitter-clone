@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Follow List</title>
</head>
<body>
    <h1>Follow List</h1>
    <ul>
        @foreach ($follows as $follow)
            <div class="d-flex align-items-center my-4">
            <li>{{ $follow->name }}</li>
            </div>
        @endforeach
    </ul>
</body>
</html>
@endsection