@extends('layouts.loginregister')
@section('title')
    Confirm Email
@endsection
@section('content')
<div class="container"id="card-labas">
    <div class="card col-md-4 mx-auto" id="card-buo-resetpass">
        <div class="row justify-content-center" id="card-resetpass">
            <div class="row card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
                <h5 class="card_tags">Reset Password</h5>
                <hr style="border: none;
                        height: 2px;
                        background: white;"
                        >
                <p style="font-size: 12px;">Forgot your password? Let us know your email address and we will email you a password reset link that will allow you to input a new one.</p>
                <div class="col-md-12">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="offset-md-5 mt-3">
                    <button type="submit" class="btn btn-success">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection
