<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Ethnic Groups</span>
                    </div>
                    <ul style="display: none;">
                        @foreach ($ethnicGroups as $group)
                            <li>
                                <a href="{{ route('shop', ['group_id' => $group->id]) }}">{{ $group->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{route('shop')}}">
                            <input type="text" name="name" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <a name="" id="" class="btn btn-danger" href="{{route('shop')}}" role="button">RESET</a>

                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{ env('NUMBER') }}</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                @if (request()->route('index'))
                    <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}">
                        <div class="hero__text">
                            <span>Best Clothes</span>
                            <h2>Religious and <br />Ethnics</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
