@extends('auth.authLayout')

@section('guestContent')
    <form role="form" method="POST" action="{{ route('password.email') }}" class="foodie-form">
        <div class="form-header">
            <h2 class="form-title">Reset Password ?</h2>
            <p class="form-subtitle">Fill the form below to send a reset password link to your email.</p>
        </div>
        @csrf
        <div class="form-row">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3" class="foodie-form">
                <input class="input-field form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-footer">
            <button type="submit" class="submit-btn">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
@endsection
