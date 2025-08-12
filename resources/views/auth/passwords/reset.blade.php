@extends('auth.authLayout')

@section('guestContent')

    <form role="form" method="POST" action="{{ route('password.update') }}" class="foodie-form">
        <div class="form-header">
            <h2 class="form-title">Reset Password ?</h2>
            <p class="form-subtitle">Fill the form below to set a new password for your account.</p>
        </div>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-row">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                <input class="input-field form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <input class=" input-field form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input class="input-field  form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-footer">
            <button type="submit" class="submit-btn">{{ __('Reset Password') }}</button>
        </div>
    </form>
@endsection
