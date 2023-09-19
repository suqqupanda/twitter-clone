@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <ul>
        @foreach ($users as $user)
            <div class="d-flex align-items-center my-4">
            <li>{{ $user->name }}</li>
            <!-- 自分にはフォローボタンは表示させない -->
            @if(Auth::id() !== $user->id)
                <!-- フォローしている場合 -->
                @if(Auth::user()->following->contains($user->id))
                    <form action="{{ route('follow.delete', ['id' => $user->id]) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-light border-secondary rounded-pill mx-4">フォロー中</button>
                    </form>
                <!-- フォローしていない場合 -->
                @else
                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-primary rounded-pill mx-4">フォロー</button>
                    </form>
                @endif
            @endif
            </div>
        @endforeach
    </ul>
    {{ $users->links() }}
</body>
</html>
@endsection