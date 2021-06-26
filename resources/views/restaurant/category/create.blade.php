@extends('layouts.app', ['title' => __('Add Category')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->first_name,
        'description' => __('Here you can register your restaurant.'),
        'class' => 'col-lg-10'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Category') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Category information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">

                                <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="category_name">{{ __('Category Name') }}</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control form-control-alternative{{ $errors->has('category_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('category_name') }}" required autofocus>
                                    @if ($errors->has('category_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
