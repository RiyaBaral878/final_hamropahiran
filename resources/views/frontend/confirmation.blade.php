@extends('frontend.layouts.main')
@section('title', 'Order Confirmation')

@section('main-content')

<!-- Confirmation Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Confirm Your Details</h4>
            <form action="{{ route('order.finalize', $data->order_id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                            <p>Full Name</p>
                            <input type="text" value="{{ $data['firstname'] . ' ' . $data['lastname'] }}" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Address</p>
                            <input type="text" value="{{ $data['address'] . ', ' . $data['city'] . ', ' . $data['state'] . ', ' . $data['country'] }}" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Postcode</p>
                            <input type="text" value="{{ $data['postcode'] }}" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Phone</p>
                            <input type="text" value="{{ $data['phone'] }}" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Email</p>
                            <input type="text" value="{{ $data['email'] }}" readonly>
                        </div>
                        <div class="checkout__input">
                            <p>Payment Type</p>
                            <input type="text" value="{{ strtoupper($data['payment_method']) }}" readonly>
                        </div>
                        @foreach ($data as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach ($cartItems as $cart)
                                    <li>{{ $cart->outfit->name }} <span>RS {{ $cart->outfit->seller->price }}</span></li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>RS {{ number_format($cartItems->sum('cost'), 2) }}</span></div>
                            <div class="checkout__order__total">Total <span>RS {{ number_format($cartItems->sum('cost'), 2) }}</span></div>
                            <button type="submit" class="site-btn">CONFIRM ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Confirmation Section End -->

@endsection
