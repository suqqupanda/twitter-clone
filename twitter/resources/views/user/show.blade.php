@extends('layouts.app')

@section('content')
    <h1>マイページ</h1>
    <p>ようこそ、{{ $user->name }}さん！</p>
    <p>Username: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    
@endsection
