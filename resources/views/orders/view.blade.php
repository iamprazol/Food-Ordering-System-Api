@extends('layouts.app', ['title' => __('Orders')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{__( 'Order Information' ) }}</h3>
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
                    <div class="order-details-container">
                        <div class="order-detail-wrapper">
                            <div class="order-info-wrap">
                                <table class="table align-items-center table-flush">
                                    <tr>
                                        <th>
                                                Ordered By:
                                        </th>
                                        <td>
                                            {{ $order->user->first_name . ' ' . $order->user->last_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                                Ordered From:
                                        </th>
                                        <td>
                                            {{ $order->restaurant->restaurant_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                                Delivery Address:
                                        </th>
                                        <td>
                                            {{ $order->address->address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Ordered Items:
                                        </th>
                                        <td>
                                            @foreach( json_decode($order->details, true) as $order_detail )
                                                {{ $order_detail['quantity'] }} x {{ $order_detail['food_name']}} {{$order_detail['special_instructions'] ? '( ' . $order_detail['special_instructions'] . ' )' : ''}} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                                Total Price:
                                        </th>
                                        <td>
                                            {{ $order->total_price }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                                Paid:
                                        </th>
                                        <td>
                                            {{ $order->payment_status === "NONE" ? "Cash On Delivery" : "Paid" }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                                Status:
                                        </th>
                                        <td class="order-status">
                                            @if ( $order->status === 'SENT_TO_RESTAURANT' )
                                                <form id="approve-order" action="{{ route('restaurant.order.accept', ['order' => $order->id ]) }}" method="POST">
                                                    @csrf
                                                        <button type="submit" class="submit-btn foodie-btn-green">{{ __('Approve') }}</button>
                                                </form>
                                                <form id="deny-order" action="{{ route('restaurant.order.reject', ['order' => $order->id ]) }}" method="POST">
                                                    @csrf
                                                        <button type="submit" class="submit-btn foodie-btn-red">{{ __('Reject') }}</button>
                                                </form>
                                             @elseif($order->status === 'ACCEPTED')
                                                <span class="badge accepted-badge">Accepted</span>
                                            @elseif($order->status === 'READY' )
                                                @if( auth()->user()->is_delivery())
                                                    <form id="approve-order" action="{{ route('order.pickup', ['order' => $order->id ]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="submit-btn foodie-btn-blue">{{ __('Accept Delivery Request') }}</button>
                                                    </form>
                                                @else
                                                    <span class="badge ready-badge">Ready for Delivery</span>
                                                @endif
                                            @elseif($order->status === 'PICKED_UP')
                                                @if(auth()->user()->is_delivery() && $order->courier_id === auth()->user()->id)
                                                    <form id="on-the-way-order" action="{{ route('order.onTheWay', ['order' => $order->id ]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="submit-btn foodie-btn-blue">{{ __('Pick Up') }}</button>
                                                    </form>
                                                @else
                                                    <span class="badge picked-up-badge">Picking Up</span>
                                                @endif
                                            @elseif($order->status === 'ON_THE_WAY')
                                                @if(auth()->user()->is_delivery() && $order->courier_id === auth()->user()->id)
                                                    <form id="deliver-order" action="{{ route('order.deliver', ['order' => $order->id ]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="submit-btn foodie-btn-green">{{ __('Delivered') }}</button>
                                                    </form>
                                                @else
                                                    <span class="badge picked-up-badge">Picking Up</span>
                                                @endif
                                            @elseif($order->status === 'DELIVERED')
                                                <span class="badge delivered-badge">Delivered</span>
                                            @elseif($order->status === 'CANCELLED')
                                                <span class="badge cancelled-badge">Cancelled</span>
                                            @endif
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
