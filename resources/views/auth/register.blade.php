@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <b-card header="{{ __('Register') }}">

                <b-form method="POST" action="{{ route('register') }}">
                    @csrf

                    <b-form-group style="margin-bottom: 0;">
                        <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <b-form-input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                value="{{ old('name') }}" required autocomplete="name" autofocus/>

                            </div>
                        </div>
                    </b-form-group>
                    @error('name')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mb-3"></div>

                    <b-form-group style="margin-bottom: 0;">
                        <div class="row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <b-form-input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" 
                                value="{{ old('username') }}" required autocomplete="username"/>

                            </div>  
                        </div>
                    </b-form-group>
                    @error('username')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mb-3"></div>

                    <b-form-group style="margin-bottom: 0;">
                        <div class="row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <b-form-input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>

                            </div>
                        </div>
                    </b-form-group>
                    @error('email')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mb-3"></div>

                    <b-form-group style="margin-bottom: 0;">
                        <div class="row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <b-form-input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>

                            </div>
                        </div>
                    </b-form-group>
                    @error('password')
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mb-3"></div>

                    <b-form-group>
                        <div class="row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <b-form-input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"/>
                            </div>
                        </div>
                    </b-form-group>

                    <b-form-group >
                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <b-button type="submit" class="pink" block variant="success">{{ __('Register') }}</b-button>
                            </div>
                            
                        </div>
                    </b-form-group>
                </b-form>
            </b-card>
        </div>
    </div>
</div>
@endsection
