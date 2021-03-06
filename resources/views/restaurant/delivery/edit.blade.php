@extends('layouts.app', ['title' => __('Delivery Boy Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add Delivery Boy')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Delivery Boy Management') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('delivery.update', ['id' => $deliveries->user_id]) }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Delivery Boy information') }}</h6>
                            <div class="pl-lg-4">

                                <div class="form-group">
                                    <label class="form-control-label" for="restaurant_id">{{ __('Restaurant Name') }}</label>
                                    <div class="form-group">
                                        <select name="restaurant_id" class="custom-select" id="restaurant_id" required>
                                            <option value="{{ $deliveries->restaurant_id }}" selected="">{{ $deliveries->restaurant->restaurant_name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="role_id">{{ __('Role') }}</label>
                                    <div class="form-group">
                                        <select name="role_id" class="custom-select" id="role_id" required>
                                            <option value="{{ $deliveries->user->role_id }}" selected="">{{ $deliveries->user->role->role }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="first_name">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-alternative{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" value="{{ old('first_name', $deliveries->user->first_name) }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="last_name">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" value="{{ old('last_name', $deliveries->user->last_name) }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $deliveries->user->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="phone">{{ __('Phone') }}</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="{{ __('Phone') }}" value="{{ old('phone', $deliveries->user->phone) }}" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection