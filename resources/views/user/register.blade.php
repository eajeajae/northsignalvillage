@extends('layouts.loginregister')

@section('title')
    Tech Service | Register 
@endsection

@section('content')
<div class="d-flex justify-content-center" id="content">
  <div class="justify-content-center" id="card-login">
    <div class="card" id="card-buo">
      <div class="card-body row">
        <div class="col-sm-6 d-grip justify-content-center">
          <img class="card-image" src="/images/logo-barangay.png" alt="" style="height:180px; width:180px;">
          <br>
          <h6 class="card-subtitle text-center" style="font-size: 20px; font-weight: bolder;">Welcom to E-Public Service of Barangay North Signal</h6>
        </div>
        <div class="col-sm-6">
          <div class="row register-form">
            <form method="post" id="registerForm" enctype="multipart/form-data" >
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-sm-12">
                <label for="name" class="col col-form-label col-form-label-sm">{{ __('Full Name') }}</label>
                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" required autofocus>
              </div>
              <div class="col-sm-12">
                <label for="valid_id" class="col col-form-label col-form-label-sm" style="color: black">{{ __('Valid ID') }}</label>
                <input class="form-control form-control-sm @error('valid_id') is-invalid @enderror" type="file" id="valid_id" name="valid_id">
              </div>
              <div class="col-sm-12">
                <label for="email" class="col col-col col-form-label col-form-label-sm">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" required autofocus>
              </div>
              <div class="col-sm-12">
                <label for="password" style="color: black"  class="col col-form-label col-form-label-sm">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control form-control-sm" name="password" autocomplete="new-password">
              </div>
              <div class="col-sm-12">
                <label for="password_confirm" style="color: black" class="col col-form-label col-form-label-sm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirm" autocomplete="new-password">
              </div>
              <div class="d-grid col-12 mx-auto mt-2">
                <button id="registerSubmit" type="submit"  class="btn btn-succes" style="background-color:green; color:white;">Register</button>
                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <p class=" btn-register">Have an account?</p>
                  </div>
                  <div class="col d-grip justify-content-start">
                     <a class="btn btn-link" href="{{route ('user.getLogin')}}">Sign in here</a>
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
