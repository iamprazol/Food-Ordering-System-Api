@extends('auth.authLayout')

@section('guestContent')
    <form role="form" method="POST" action="{{ route('register') }}" class="foodie-form">
        <div class="form-header">
            <h2 class="form-title">Hello User</h2>
            <p class="form-subtitle">Fill the form below to create an account</p>
        </div>
        @csrf
        <div class="form-row">
            <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                <label class="input-label" for="first_name">First Name</label>
                <input class="input-field form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                <label class="input-label" for="last_name">Last Name</label>
                <input class="input-field form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>
                @if ($errors->has('last_name'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <label class="input-label" for="email">Email</label>
                <input class="input-field form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                <label class="input-label" for="role">Role</label>
                <select class="input-field form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" id="role" required>
                    <option value="" disabled selected>{{ __('Select Registration Type') }}</option>
                    <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Restaurant Manager</option>
                    <option value="delivery" {{ old('role') == 'delivery' ? 'selected' : '' }}>Delivery Rider</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Guest User</option>
                </select>

                @if ($errors->has('role'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('role') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <label class="input-label" for="password">Password</label>
                <input class="input-field form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label class="input-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input class="input-field form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-footer">
            <button type="submit" class="submit-btn">{{ __('Create account') }}</button>
        </div>
    </form>
@endsection
