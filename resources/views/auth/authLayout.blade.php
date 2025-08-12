@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

<div class="foodie-container">
    <div class="foodie-container--left">
        <div class="brand-content">
            <div class="brand-logo">
                <img src="{{ asset('images/logo/foodie.png') }}" alt="Foodie Logo" />
            </div>
            <h1 class="brand-title">Foodie Dashboard</h1>
            <p class="brand-subtitle">Manage your operations<br>with our powerful dashboard</p>
        </div>
    </div>
    <div class="foodie-container--right">
       @yield('guestContent')
    </div>
</div>
@endsection
