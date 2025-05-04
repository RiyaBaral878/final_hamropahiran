@extends('frontend.layouts.main')
@section('title', 'Product Detail')

@section('main-content')

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ asset('storage/' . $outfit->photo) }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$outfit->name}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            {{-- <i class="fa fa-star-half-o"></i> --}}
                        </div>
                        <div class="product__details__price">RS {{$outfit->seller->price}}</div>
                        <p>{{$outfit->description}}</p>
                        <form action="{{route('cart.store', ['outfit_id' => $outfit->id])}}" method="post">
                            @csrf
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" min="1" name="quantity" value="1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">ADD TO CART</button>
                        </form>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Historical Context</b> <span>{{$outfit->historical_context ? "Yes" : "No"}}</span></li>
                            <li><b>Uses</b> <span>{{$outfit->uses}}</span></li>
                            <li><b>Used in festival</b> <span>{{$outfit->used_in_festivals ? "Yes" : "No"}}</span></li>
                            <li><b>Used in rituals</b> <span>{{$outfit->used_in_rituals ? "Yes" : "No"}}</span></li>

                            <li><b>Build materials</b>
                                <div class="share">
                                    @foreach ($outfit->materials as $item)
                                        <span>{{$item->material_name}} | {{$item->description}}</span>
                                    @endforeach
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Sellers Information</h6>
                                    <h3>Sellers Name: {{$outfit->seller->seller_name}}</h3>
                                    <div>Contact: {{$outfit->seller->seller_contact}}</div>
                                    <p>Address: {{$outfit->seller->seller_address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($outfits as $outfit)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'. $outfit->photo)}}">
                                <ul class="product__item__pic__hover">
                                    <a name="" id="" class="btn btn-primary" href="{{route('productDetail', $outfit->id)}}"
                                        role="button">View More</a>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{route('productDetail', $outfit->id)}}">{{$outfit->name}}</a></h6>
                                <h5>RS {{$outfit->seller->price}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection
