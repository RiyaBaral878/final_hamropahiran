@extends('frontend.layouts.main')
@section('title', 'Checkout')

@section('main-content')

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{route('checkout.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="firstname">
                                        @error('firstname')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastname">
                                        @error('lastname')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" value="Nepal">
                                @error('country')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" name="address" class="checkout__input__add">
                                @error('address')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city">
                                @error('city')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state">
                                @error('state')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="postcode">
                                @error('postcode')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone">
                                        @error('phone')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email">
                                        @error('email')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($cartItems as $cart)
                                        
                                    <li>{{$cart->outfit->name}} <span>RS {{$cart->outfit->seller->price}}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>RS {{ number_format($cartItems->sum('cost'), 2) }}</span></div>
                                <div class="checkout__order__total">Total <span>RS {{ number_format($cartItems->sum('cost'), 2) }}</span></div>
                                
                                <p>Choose your payment Type</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        COD
                                        <input type="radio" value="cod" name="payment_type" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="esewa">
                                        Esewa
                                        <input type="radio" value="esewa" name="payment_type" id="esewa">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @error('payment_type')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


@endsection
