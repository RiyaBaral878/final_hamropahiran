@extends('frontend.layouts.main')
@section('title', 'Payment Failed')

@section('main-content')
<section class="checkout spad text-center">
    <div class="container">
        <h2 class="text-danger mb-3">Payment Failed 😞</h2>
        <p>Something went wrong with your payment. Please try again or choose another payment method.</p>
        <a href="{{ route('frontend.checkout') }}" class="site-btn mt-3">Retry Checkout</a>
    </div>
</section>
@endsection