@extends('frontend.layouts.main')
@section('title', 'Shop')

@section('main-content')

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="row">

                        @foreach ($outfits as $outfit)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ asset('storage/' . $outfit->photo) }}">
                                        <ul class="product__item__pic__hover">
                                            <a name="" id="" class="btn btn-primary"
                                                href="{{ route('productDetail', $outfit->id) }}" role="button">View
                                                More</a>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">{{ $outfit->name }}</a></h6>
                                        <h5>RS {{ $outfit->seller->price }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $outfits->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


@endsection
