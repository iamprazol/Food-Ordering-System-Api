@extends('layouts.app', ['title' => __('Reviews')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Reviews') }}</h3>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="row">
                        @if(auth()->user()->role_id == 1)
                        <div class="col-9">
                            <form action="{{ route('reviews.search') }}" method="get">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label" for="restaurant_id" style="margin-left: 1rem;">{{ __('Restaurant Name') }}</label>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <select name="restaurant_id" class="custom-select" id="restaurant_id" style="margin-left: 1rem; font-size: 0.82rem; height:1.8rem;" required>
                                                    <option value="" selected="">Choose One</option>
                                                    @foreach($restaurants as $restaurant)
                                                        <option value="{{ $restaurant->id }}">{{ $restaurant->restaurant_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <input class="btn btn-primary btn-pill d-flex ml-auto mr-auto" name="submit" type="submit" value="Search" style="height:1.8rem; font-size: 0.82rem; line-height: 0.5rem;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Restaurant Name') }}</th>
                                <th scope="col">{{ __('Reviewer') }}</th>
                                <th scope="col">{{ __('Review') }}</th>
                                <th scope="col">{{ __('Options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->restaurant->restaurant_name }}</td>
                                    <td>{{ $review->name }}</td>
                                    <td>{{ $review->review }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('reviews.destroy', $review->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this Review?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $reviews->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection