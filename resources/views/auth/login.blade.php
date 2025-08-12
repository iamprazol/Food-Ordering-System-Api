@extends('auth.authLayout')

@section('guestContent')

<form role="form" method="POST" action="{{ route('login') }}" class="foodie-form">
    <div class="form-header">
        <h2 class="form-title">Welcome back</h2>
        <p class="form-subtitle">Sign in to your account</p>
    </div>
    @csrf
    <div class="form-row">
        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
            <label class="input-label" for="email">Email</label>
            <input class="input-field form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('iamprazol@gmail.com') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
    </div>
    <div class="form-row">
        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
            <label class="input-label" for="email">Password</label>
            <input class="input-field form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
    </div>

    <div class="form-options">
        <div class="checkbox-wrapper">
            <input class="checkbox" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
            <label class="checkbox-label" for="customCheckLogin">
                <span>{{ __('Remember me') }}</span>
            </label>
        </div>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-link">
                {{ __('Forgot password?') }}
            </a>
        @endif
    </div>
    <div class="form-footer">
        <button type="submit" class="submit-btn">{{ __('Sign in') }}</button>
        <a href="{{ route('register') }}" class="create-new-link">
            {{ __('Not a member yet? Register now.') }}
        </a>
    </div>
</form>
@endsection
