<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>RS 150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{ env('EMAIL') }}</li>
            <li>Free Shipping for all Order of RS 2000</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{ env('EMAIL') }}</li>
                            <li>Free Shipping for all Order of RS 2000</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">

                        <div class="header__top__right__auth">
                            @guest
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                            @else
                                <div>
                                    <a href="{{ route('frontend.orders.index') }}" class="d-inline-block mx-2"><i class="fa fa-user"></i> orders</a>
                                    <form action="{{ route('logout') }}" method="post" class="d-inline-block mx-2">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">
                                            Logout
                                        </button>

                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('index') }}"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->routeIs('index') ? 'active' : '' }}"><a
                                href="{{ route('index') }}">Home</a></li>
                        <li class="{{ request()->routeIs('shop') ? 'active' : '' }}"><a
                                href="{{ route('shop') }}">Shop</a></li>
                        {{-- <li><a href="{{route('blog')}}">Blog</a></li> --}}
                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a
                                href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ route('getCart') }}"><i class="fa fa-shopping-bag" title="Cart"></i>
                                <span>{{ $carts->count() }}</span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>RS
                            {{ number_format($carts->sum('cost') ?? 0, 2) }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
