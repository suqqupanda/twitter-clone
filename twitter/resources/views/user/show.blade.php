@extends('layouts.app')

@section('content')
    <h1>マイページ</h1>
    <p>ようこそ、{{ $user->name }}さん！</p>
    <p>Username: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <!-- 他のユーザー情報を表示する場合はここに追加 -->
@endsection