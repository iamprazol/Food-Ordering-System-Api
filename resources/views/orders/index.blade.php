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
                                <h3 class="mb-0">{{ __('Orders') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Ordered By') }}</th>
                                    <th scope="col">{{ __('Ordered From') }}</th>
                                    <th scope="col">{{ __('Delivery Address') }}</th>
                                    <th scope="col">{{ __('Total Price') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Options') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                                        <td>
                                            {{ $order->restaurant->restaurant_name}}
                                        </td>
                                        <td>{{ $order->address->address }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>
                                            @if($order->status === 'SENT_TO_RESTAURANT' )
                                                <span class="badge pending-badge">Pending Approval</span>
                                            @elseif($order->status === 'ACCEPTED')
                                                <span class="badge accepted-badge">Accepted</span>
                                            @elseif($order->status === 'READY')
                                                <span class="badge ready-badge">Ready for Delivery</span>
                                            @elseif($order->status === 'PICKED_UP')
                                                <span class="badge ready-badge">Picking Up</span>
                                            @elseif($order->status === 'ON_THE_WAY')
                                                <span class="badge ready-badge">Out for Delivery</span>
                                            @elseif($order->status === 'DELIVERED')
                                                <span class="badge delivered-badge">Delivered</span>
                                            @elseif($order->status === 'CANCELLED')
                                                <span class="badge cancelled-badge">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="d-flex align-items-center action-btn-container">
                                                <a href="{{ route('orders.view', ['id' => $order->id ]) }}" class="action-btn view-btn" >
                                                   <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"
                                                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <circle cx="12" cy="12" r="3" stroke="white" stroke-width="2"/>
                                                    </svg>
                                                </a>
                                                @if($order->status === 'SENT_TO_RESTAURANT' && auth()->user()->is_manager() )
                                                    <form id="approve-order" action="{{ route('restaurant.order.accept', ['order' => $order->id ]) }}" method="POST">
                                                        @csrf
                                                            <button type="submit" class="action-btn approve-btn" data-toggle="tooltip" data-placement="bottom" title="Approve Order">
                                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                    <path d="M5 12.5l4 4 10-10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        <form id="deny-order" action="{{ route('restaurant.order.reject', ['order' => $order->id ]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="action-btn deny-btn" data-toggle="tooltip" data-placement="bottom" title="Reject Order">
                                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                    <path d="M6 6l12 12M18 6L6 18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                                                </svg>
                                                            </button>
                                                    </form>
                                                @endif
                                                @if($order->status === 'ACCEPTED' && auth()->user()->is_manager())
                                                    <form id="approve-order" action="{{ route('restaurant.order.ready', ['order' => $order->id ]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="action-btn ready-btn">
                                                           <svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                                                                <g stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">

                                                                    <ellipse cx="12" cy="20" rx="10" ry="2" stroke-width="1"></ellipse>

                                                                    <path d="M3 18 Q3 8 12 8 Q21 8 21 18" stroke-width="1.5"></path>

                                                                    <circle cx="12" cy="8" r="1" stroke-width="1"></circle>
                                                                    <line x1="12" y1="7" x2="12" y2="6" stroke-width="1"></line>

                                                                    <g stroke-width="1">
                                                                    <path d="M8 5 Q9 4 8 3 Q7 2 8 1"></path>
                                                                    <path d="M12 5.5 Q13 4.5 12 3.5 Q11 2.5 12 1.5"></path>
                                                                    <path d="M16 5 Q17 4 16 3 Q15 2 16 1"></path>
                                                                    </g>

                                                                    <ellipse cx="12" cy="18" rx="10.5" ry="1" stroke-width="0.5"></ellipse>

                                                                </g>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($order->status === 'READY' && auth()->user()->is_delivery() )
                                                    <form id="pickup-order" action="{{ route('order.pickup', ['order' => $order->id ]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="action-btn approve-btn" data-toggle="tooltip" data-placement="bottom" title="Accept Delivery Request">
                                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path d="M5 12.5l4 4 10-10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($order->status === 'PICKED_UP' )
                                                    @if($order->courier_id === auth()->user()->id )
                                                        <form id="on-the-way-order" action="{{ route('order.onTheWay', ['order' => $order->id ]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="action-btn approve-btn" data-toggle="tooltip" data-placement="bottom" title="Pick Up">
                                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                    <path d="M5 12.5l4 4 10-10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $orders->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
