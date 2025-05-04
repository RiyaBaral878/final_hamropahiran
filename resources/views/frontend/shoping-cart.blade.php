@extends('frontend.layouts.main')
@section('title', 'Carts')
@section('main-content')

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Outfits</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('storage/' . $cart->outfit->photo) }}" height="100px"
                                                width="100px" alt="">
                                            <h5>{{ $cart->outfit->name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            RS {{ $cart->outfit->seller->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <form action="{{ route('cart.update', $cart->id) }}" method="post"
                                                class="d-inline-block">
                                                @csrf
                                                @method('PUT')
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" name="quantity" value="{{ $cart->quantity }}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Update
                                                </button>

                                            </form>
                                        </td>
                                        <td class="shoping__cart__total">
                                            RS {{ number_format($cart->cost, 2) }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span class="icon_close"
                                                onclick="document.getElementById('myCartForm{{$cart->id}}').submit();"></span>
                                        </td>
                                        <form id="myCartForm{{$cart->id}}" action="{{route('cart.delete', $cart->id)}}"
                                            method="post" class="d-hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route(name: 'shop') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>RS {{ number_format($carts->sum('cost'), 2) }}</span></li>
                            <li>Total <span>RS {{ number_format($carts->sum('cost'), 2) }}</span></li>
                        </ul>
                        <a href="{{route('getCheckout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection