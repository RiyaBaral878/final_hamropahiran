@extends('frontend.layouts.main')
@section('title', 'Index')

@section('main-content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($outfits as $outfit)
                        @php
                            $i++;
                        @endphp
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('storage/' . $outfit->photo) }}">
                                <h5><a href="#">{{ $outfit->ethnicGroup->name }}</a></h5>
                            </div>
                        </div>
                        @if ($i == 5)
                            @break
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Outfits</h2>
                    </div>
                    
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($outfits as $outfit)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ asset('storage/' . $outfit->photo) }}">
                                <ul class="featured__item__pic__hover">
                                    {{-- <li><a href="#">View More</a></li> --}}
                                    <a name="" id="" class="btn btn-primary" href="{{route('productDetail', $outfit->id)}}"
                                        role="button">View More</a>

                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $outfit->name }}</a></h6>
                                <h5>RS {{ $outfit?->seller?->price }}
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Featured Section End -->



@endsection
