@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <b-card class="mt-4 shadow-sm" header="{{ __('Login') }}">
                <b-form method="POST" action="{{ route('login') }}">
                    @csrf
                    <b-form-group
                        id="input-group-1"
                        label="{{ __('E-Mail/Username') }}"
                        label-for="username"
                        style="margin-bottom: 0;"
                      >
                        <b-form-input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus/>

                    </b-form-group>
                    @error('username')
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="mb-3"></div>
                    <b-form-group
                        id="input-group-2"
                        label="{{ __('Password') }}"
                        label-for="password"
                        style="margin-bottom: 0"
                      >
                        <b-form-input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                    </b-form-group>
                    @error('password')
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="mb-3"></div>
                    <b-form-group>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </b-form-group>
                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <b-button type="submit" class="pink" block variant="success">{{ __('Submit') }}</b-button>
                            <p class="mt-3 text-center">Not a member? <a href="{{ route('register') }}">Sign Up now!</a></p>
                            <!-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif -->
                        </div>
                    </div>
                </b-form>
            </b-card>
        </div>
    </div>
</div>
@endsection
