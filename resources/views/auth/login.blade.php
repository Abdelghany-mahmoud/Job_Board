@extends('layouts.app')
<style>
    .login-form {
        width: 500px;
        margin: auto;
        margin-top: 40px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 20px;
        border-radius: 5px;
    }

    .login-form .login-input {
        padding: 10px;
    }
    
    .login-form .login-input label {
        padding: 10px;
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
    
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="login-form">
                <h4 style="text-align: center; margin-bottom: 20px;">Welcome Back</h4>
        <div style="margin-left: 10px;" class="sign-up-with-google">
            <img width="30" src="{{ asset('logos/google.png') }}" alt="">
            <span>Sign In with Google</span>
        </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="login-input">
                            <label for="email" class="">{{ __('Email') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="login-input">
                            <label for="password" class="">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="login-input">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="login-input">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
