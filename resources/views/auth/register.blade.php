@extends('layouts.template')

@section('content')
<div class="container-fluid jumbotron">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card shadow">
                <div class="card-header text-center mt-4">
                    <img src="{{ asset('img/logo.svg') }}" alt="" class="img-fluid" width="140vw">
                    <h3 style="font-weight: 600; font-size: 1.5rem" class="mt-3">Register</h3>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input id="type" type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="1" required autocomplete="type" >

                        <div class="row mb-3">
                            <div class="col-12  mb-3">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
        
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 ">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <div class="input-group input-group-merge justify-content-center">
                                <button type="submit" class="btn"
                                    style="background-color: #1DC88A; color:white; border-radius:20px; width:100%">
                                    {{ __('Register') }}
                                </button>
                                <p class="mt-3 mb-0">Already have an account?<a href="{{ route('login') }}" style="text-decoration: underline">{{ __('Login') }}</a></p>
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
