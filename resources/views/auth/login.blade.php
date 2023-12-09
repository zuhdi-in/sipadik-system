
@extends('layouts.template')

@section('content')
<div class="container-fluid jumbotron">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card shadow">
                <div class="card-header text-center mt-4">
                    <img src="{{ asset('img/logo.svg') }}" alt="" class="img-fluid" width="140vw">
                    <h3 style="font-weight: 600; font-size: 1.5rem" class="mt-3">Login</h3>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input id="type" type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="1" required autocomplete="type" >

                        <div class="row mb-3">
        
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <div class="input-group input-group-merge ">
                                <button type="submit" class="btn"
                                    style="background-color: #1DC88A; color:white; border-radius:20px; width:100%">
                                    {{ __('Register') }}
                                </button>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <p class="mt-3 mb-0">Need an account?<a href="{{ route('register') }}" style="text-decoration: underline">{{ __('Register') }}</a></p>
                            </div>
                        </div>
                    </form>
                </div>  
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
