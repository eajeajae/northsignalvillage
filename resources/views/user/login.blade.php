@extends('layouts.loginregister')

@section('title')
    Login
@endsection

@section('content')
<div class="d-flex justify-content-center" id="content">
  <div class="justify-content-center" id="card-login">
    <div class="card" id="card-buo">
    @if(Session::get('success'))
    <div class = "alert alert-success text-center" style="font-weight: bolder;">
      {{ Session::get('success')}}
    </div>
    @endif  
      <div class="card-body row">
        <div class="col-sm-6 d-grip justify-content-center">
          <img class="card-image" src="/images/logo-barangay.png" alt="" style="height:180px; width:180px;">
          <br>
          <h6 class="card-subtitle text-center" style="font-size: 12px; font-weight: bolder;">E-Public Service of Barangay North Signal</h6>
        </div>
        <div class="col-sm-6">
          <div class="row login-form">
            <form id="loginForm" action="{{route('user.postLogin')}}" method="post" enctype="multipart/form-data" >
              {{ csrf_field() }}
              <div class="col-sm-12">
                <label for="email" class="col col-form-label col-form-label-sm">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" required autofocus>
              </div>
              <div class="col-sm-12">
                <label for="password" class="col col-form-label col-form-label-sm">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required >
              </div>
              @if (Route::has('password.request'))
              <a class="btn btn-link d-md-flex justify-content-md-end btn-forgotpass" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
              @endif
              <div class="d-grid col-12 mx-auto">
                <button id="loginSubmit" type="submit" class="btn btn-login" >Login</button>
                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <p class=" btn-register">Don't have an account?</p>
                  </div>
                  <div class="col d-grip justify-content-start">
                    <a class="btn btn-link" href="{{route ('user.getRegister')}}">
                      {{ __('Register Here') }}
                    </a>
                  </div>
                </div>
                <a class="btn btn-link" href="{{url ('/')}}">
                  {{ __('Back to Home') }}
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

