@extends('layouts.app', ['title' => __('Edit Food')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->first_name,
        'description' => __('Here you can edit food in restaurant.'),
        'class' => 'col-lg-10'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Food Item') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('food.update', ['id' => $foods->id]) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Food information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="restaurant_id">{{ __('Restaurant Name') }}</label>
                                    <div class="form-group">
                                        <select name="restaurant_id" class="custom-select" id="restaurant_id" required>
                                            <option value="{{ $foods->restaurant_id }}" selected="">{{ $foods->restaurant->restaurant_name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="category_name">{{ __('Category Name') }}</label>
                                    <div class="form-group">
                                        <select name="category_id" class="custom-select" id="category_id" required>
                                            <option value="{{ $foods->category_id }}" selected="">{{ $foods->category->category_name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('food_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="food_name">{{ __('Food Name') }}</label>
                                    <input type="text" name="food_name" id="food_name" class="form-control form-control-alternative{{ $errors->has('food_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Food Name') }}" value="{{ old('food_name', $foods->food_name) }}" required autofocus>
                                    @if ($errors->has('food_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('food_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="price">{{ __('Price') }}</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price', $foods->price) }}" required autofocus>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="form-control-label" for="picture">{{ __('Picture') }}</label>
                                        <div class="col-md-6">
                                            @if($foods->picture)
                                                <img src="/images/food/{{ $foods->picture }}" style="width:150px; height:150px;">
                                            @else
                                                <p>No image found</p>
                                            @endif
                                            @if ($errors->has('picture'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('picture', 'Image size must be less than 15 MB')}}</strong>
                                                </span>
                                            @endif
                                            <input type="file" id="picture" name="picture" class="form-control{{ $errors->has('picture') ? ' is-invalid' : '' }}"  required/>
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
