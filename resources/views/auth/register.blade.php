@extends('layouts.app')

<style>
  .register-form {
    width: 600px;
    padding: 10px;
    border-radius: 5px;
  }
  
  .sign-up-with-google {
    background: #4285F4;
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    width: 450px;
    cursor: pointer;
    display: flex;
    align-items: center;
  }
  
  .sign-up-with-google img {
    border-radius: 5px;
    margin-right: 5px;
  }
  
  form {
    margin-top: 20px;
  }
  
  label {
    display: block;
  }
  
  .input-field {
    margin-top: 15px;
  }
  
  .input-field input[type="text"],
  .input-field input[type="email"],
  .input-field input[type="password"] {
    width: 450px;
  }
  
  .check-box-btn {
    margin-bottom: 20px;
  }
  
  .check-box-btn div {
    margin-top: 15px;
  }
  
  .register-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }
  
  .register-form-wrapper {
    flex: 1;
    margin-right: 20px;
    margin-top: 20px;
  }
  
  .register-image-wrapper {
    flex: 1;
    text-align: right;
    margin-top: 80px;
    
   
  }
  
  .register-image-wrapper img {
    max-width: 100%;
    height: auto;
  }

  .submit-btn button {
    font-weight: bold;
    letter-spacing: .3px;
    text-align: center;
    width: 450px;
  }
</style>

@section('content')
<div class="container">
  <div class="register-container">
    <div class="register-form-wrapper">
      
      <div style="margin-left: 10px;" class="sign-up-with-google">
        <img width="30" src="{{ asset('logos/google.png') }}" alt="">
        <span>Sign Up with Google</span>
      </div>
      <div class="register-form">
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-field">
              <label for="name">{{ __('Name') }}</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="input-field">
              <label for="email">{{ __('Email') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="input-field">
              <label for="password">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="input-field">
              <label for="password-confirm">{{ __('Confirm Password') }}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="input-field check-box-btn">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="employer">
                <label class="form-check-label" for="flexRadioDefault1">Employer</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2" value="job_seeker">
                <label class="form-check-label" for="flexRadioDefault2">Job Seeker</label>
              </div>
            </div>
            
            <div class="submit-btn mb-0">
              <button type="submit" class="btn btn-secondary" style="border-radius: 5px;">
                {{ __('Create Account') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="register-image-wrapper">
      <img src="{{ asset('images/register.svg') }}" alt="Registration Image" class="img-fluid">
    </div>
  </div>
</div>
@endsection
