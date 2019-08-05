@extends('layouts.app', ['title' => __('Restaurant Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Restaurant') }}</h3>
                            </div>
                        </div>
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
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Cusine') }}</th>
                                <th scope="col">{{ __('Delivery hours') }}</th>
                                <th scope="col">{{ __('Minimum Order') }}</th>
                                <th scope="col">{{ __('Cover Picture') }}</th>
                                <th scope="col">{{ __('Picture') }}</th>
                                <th scope="col">{{ __('Address') }}</th>
                                <th scope="col">{{ __('Discount') }}</th>
                                <th scope="col">{{ __('Vat') }}</th>
                                <th scope="col">{{ __('Additional Charge') }}</th>
                                <th scope="col">{{ __('Description') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($restaurants as $restaurant)
                                <tr>
                                    <td>{{ $restaurant->restaurant_name }}</td>
                                    <td>{{ $restaurant->restaurant_name }}</td>
                                    <td>{{ $restaurant->delivery_hours }}</td>
                                    <td>{{ $restaurant->minimum_order }}</td>
                                    <td><div class="card-img"><img src="/images/restaurant/{{ $restaurant->cover_pic }}" style="width:80px; height:80px;"/></div></td>
                                    <td><div class="card-img"><img src="/images/restaurant/{{ $restaurant->picture }}" style="width:80px; height:80px;"/></div></td>
                                    <td>{{ $restaurant->address }}</td>
                                    <td>{{ $restaurant->discount }}</td>
                                    <td>{{ $restaurant->vat }}</td>
                                    <td>{{ $restaurant->additional_charge }}</td>
                                    <td>{{ str_limit($restaurant->description, $limit = 50, $end = '...') }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ '#' }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <a class="dropdown-item" href="{{ route('restaurant.edit', ['id' => $restaurant->user_id]) }}">{{ __('Edit') }}</a>
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
                            {{ $restaurants->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection