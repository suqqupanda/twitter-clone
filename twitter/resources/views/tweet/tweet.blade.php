@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Tweet') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweet.post') }}">
                        @csrf

                        <div class="form-group">
                            <label for="tweet">{{ __('Tweet') }}</label>
                            <textarea id="tweet" class="form-control @error('tweet') is-invalid @enderror" name="tweet" rows="4" required>{{ old('tweet') }}</textarea>

                            @error('tweet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create Tweet') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection