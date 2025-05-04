@extends('frontend.layouts.main')
@section('title', 'Order Success')

@section('main-content')

    <!-- Order Success Message -->
    <section class="checkout spad">
        <div class="container">
            <div class="text-center">
                <img src="{{ asset('frontend/img/success.png') }}" alt="Success" width="100" class="mb-4">
                <h2 class="text-success">Thank You for Your Order!</h2>
                <p>Your order <strong>#{{ $order->id }}</strong> has been placed successfully.</p>
                <p>We’ve sent a confirmation email to <strong>{{ $order->email }}</strong></p>

                <div class="mt-4">
                    <h5>Order Summary</h5>
                    <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                </div>

                <a href="{{ route('frontend.orders.index') }}" class="site-btn mt-4">View My Orders</a>
            </div>
        </div>
    </section>

@endsection