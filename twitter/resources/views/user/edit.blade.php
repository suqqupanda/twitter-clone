@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Mypage</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('mypage.update') }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Mypage</button>
        </form>
        
        <form action="{{ route('mypage.delete') }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-primary">Delete Mypage</button>
        </form>
    </div>
@endsection
