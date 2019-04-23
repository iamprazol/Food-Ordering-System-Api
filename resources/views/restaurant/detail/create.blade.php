@extends('layouts.app', ['title' => __('Register Restaurant')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->first_name,
        'description' => __('You don\'t have a Restaurant registered. Here you can register your restaurant.'),
        'class' => 'col-lg-10'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Register Restaurant') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('restaurant.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Restaurant information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('restaurant_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="restaurant_name">{{ __('Restaurant Name') }}</label>
                                    <input type="text" name="restaurant_name" id="restaurant_name" class="form-control form-control-alternative{{ $errors->has('restaurant_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('restaurant_name') }}" required autofocus>

                                    @if ($errors->has('restaurant_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('restaurant_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="address">{{ __('Address') }}</label>
                                    <input id="address" type="text" class="form-control" name="address"  placeholder="{{__('City')}}" value="{{ old('address') }}" required>
                                </div>

                                <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Description') }}</label>
                                    <textarea type="text" name="description" id="description" rows ="10" cols = "5" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required autofocus></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="delivery_from">{{ __('Delivery From') }}</label>
                                            <input type="text" name="delivery_from" id="delivery_from" class ="form-control datepicker" placeholder="{{ __('1 pm') }}" value="{{ old('delivery_from') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="delivery_to">{{ __('Delivery To') }}</label>
                                            <input type="text" name="delivery_to" id="delivery_to" class ="form-control datepicker" placeholder="{{ __('8 pm') }}" value="{{ old('delivery_to') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="minimum_order">{{ __('Minimum Order') }}</label>
                                            <input type="text" name="minimum_order" id="minimum_order" class="form-control" placeholder="{{ __('400 (In Rs)') }}" value="{{ old('minimum_order') }}" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="discount">{{ __('Discount') }}</label>
                                            <input type="text" name="discount" id="discount" class="form-control" placeholder="{{ __('10 (In Percentage)') }}" value="{{ old('discount') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="additional_charge">{{ __('Additional Service Charge') }}</label>
                                            <input type="text" name="additional_charge" id="additional_charge" class="form-control" placeholder="{{ __('10 (In Percentage)') }}" value="{{ old('additional_charge') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vat">{{ __('Vat') }}</label>
                                            <input type="text" name="vat" id="vat" class="form-control" placeholder="{{ __('10 (In Percentage)') }}" value="{{ old('vat') }}" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="form-control-label" for="picture">{{ __('Picture') }}</label>
                                            <div class="col-md-6">
                                                @if ($errors->has('picture'))
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('picture', 'Image size must be less than 15 MB')}}</strong>
                                                        </span>
                                                @endif
                                                <input type="file" id="picture" name="picture" class="form-control{{ $errors->has('picture') ? ' is-invalid' : '' }}"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="form-control-label" for="cover_pic">{{ __('Cover Picture') }}</label>
                                            <div class="col-md-6">
                                                @if ($errors->has('cover_pic'))
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('cover_pic', 'Image size must be less than 15 MB')}}</strong>
                                                        </span>
                                                @endif
                                                <input type="file" id="cover_pic" name="cover_pic" class="form-control{{ $errors->has('cover_pic') ? ' is-invalid' : '' }}" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
<script>
    $('#delivery_from').pickatime({
        // 12 or 24 hour
        twelvehour: true,
    });
</script>