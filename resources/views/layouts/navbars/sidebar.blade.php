<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ redirect('/') }}">
            <img src="/images/logo/foodie.png" class="navbar-brand-img" alt="..." style=" max-height: 5.5rem !important;">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ redirect('/') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                @if(auth()->user()->role->role !== "user")
                    <li class="nav-item">
                        <?php $order_link = auth()->user()->is_delivery() ? route('order.show') : ( auth()->user()->is_manager() ? route('restaurant.orders.show') : route('orders.index') ); ?>
                        <a class="nav-link" href="{{ $order_link }}">
                            <i class="ni ni-bullet-list-67"></i> {{ __('Orders') }}
                            <?php
                                if (auth()->user()->is_delivery()) {
                                    $ordersCount = App\Order::where('status', 'READY')->count();
                                } else {
                                    $ordersCount = auth()->user()->restaurant->order()->where('status', 'SENT_TO_RESTAURANT')->count();
                                }
                            ?>
                            @if( $ordersCount > 0 )
                                <span class="foodie-notification-badge">{{$ordersCount}}</span>
                            @endif
                        </a>
                    </li>
                    @if(auth()->user()->role->role == "admin")
                        <li class="nav-item">
                            <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                                <i class="ni ni-shop" style="color: #f4645f;"></i>
                                <span class="nav-link-text" style="color: #f4645f;">{{ __('Users') }}</span>
                            </a>

                            <div class="collapse show" id="navbar-examples">
                                <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.create')  }}">
                                                {{ __('Add User') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.index') }}">
                                                {{ __('Super Admins') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.customers') }}">
                                                {{ __('Customers') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.managers') }}">
                                                {{ __('Managers') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.show') }}">
                                            {{ __('Food Category') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.delivery') }}">
                                            {{ __('Delivery Boy') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif

                @if(auth()->user()->role->role !== "delivery")
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                            <i class="ni ni-shop" style="color: #f4645f;"></i>
                            <span class="nav-link-text" style="color: #f4645f;">{{ __('Restaurant') }}</span>
                        </a>

                        <div class="collapse show" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                @if(auth()->user()->role_id == 2)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('restaurant.edit', ['id' => auth()->id()]) }}">
                                            {{ __('Restaurant profile') }}
                                        </a>
                                    </li>
                                @elseif(auth()->user()->role_id == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('restaurant.show') }}">
                                            {{ __('Restaurant Management') }}
                                        </a>
                                    </li>
                                @endif

                                @if(auth()->user()->restaurant || auth()->user()->role_id == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('food.show') }}">
                                            {{ __('Foods') }}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('branches.show') }}">
                                            {{ __('Branches') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('reviews.show') }}">
                                            {{ __('Reviews') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
