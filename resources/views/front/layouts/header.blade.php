<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item">
                                <a title="Hotline: (+123) 456 789" href="#"><span
                                        class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>
                            {{--<li class="menu-item lang-menu menu-item-has-children parent">
                                <a title="English" href="#"><span class="img label-before"><img
                                            src="{{ asset('assets/images/lang-en.png') }}"
                                            alt="lang-en"></span>English<i class="fa fa-angle-down"
                                                                           aria-hidden="true"></i></a>
                                <ul class="submenu lang">
                                    <li class="menu-item"><a title="hungary" href="#"><span
                                                class="img label-before"><img
                                                    src="{{ asset('assets/images/lang-hun.png') }}"
                                                    alt="lang-hun"></span>Hungary</a></li>
                                    <li class="menu-item"><a title="german" href="#"><span
                                                class="img label-before"><img
                                                    src="{{ asset('assets/images/lang-ger.png') }}"
                                                    alt="lang-ger"></span>German</a></li>
                                    <li class="menu-item"><a title="french" href="#"><span
                                                class="img label-before"><img
                                                    src="{{ asset('assets/images/lang-fra.png') }}"
                                                    alt="lang-fre"></span>French</a></li>
                                    <li class="menu-item"><a title="canada" href="#"><span
                                                class="img label-before"><img
                                                    src="{{ asset('assets/images/lang-can.png') }}"
                                                    alt="lang-can"></span>Canada</a></li>
                                </ul>
                            </li>--}}
                            @guest
                                <li class="menu-item"><a title="Register or Login" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="menu-item"><a title="Register or Login"
                                                         href="{{ route('register') }}">Register</a>
                                </li>
                            @endguest
                            @auth
                                <li class="menu-item menu-item-has-children parent">
                                    <a title="profile" href="#">{{ auth()->user()->name }}<i class="fa fa-angle-down"
                                                                                             aria-hidden="true"></i></a>
                                    <ul class="submenu curency">
                                        <li class="menu-item">
                                            <a title="My Account" href="{{route('profile.index')}}">My Profile</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="My Orders" href="{{ route('orders.index') }}">My Orders</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Logout" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="index.html" class="link-to-home"><img
                                src="{{ asset('assets/images/logo-top-1.png') }}" alt="mercado"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="{{route('shop')}}" method="GET" id="form-search-top" name="form-search-top">
                                <input type="text" name="search" placeholder="Search Products here..."/>
                                <button form="form-search-top" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="wrap-icon right-section">
                        @livewire('wishlist-count')
                        @livewire('cart-count')
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                {{--<div class="header-nav-section">
                    <div class="container">
                        <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info">
                            <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top new items</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span
                                    class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span
                                    class="nav-label hot-label">hot</span></li>
                        </ul>
                    </div>
                </div>--}}

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                            <li class="menu-item home-icon">
                                <a href="{{ route('home') }}" class="link-term mercado-item-title"><i
                                        class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            {{--<li class="menu-item">
                                <a href="about-us.html" class="link-term mercado-item-title">About Us</a>
                            </li>--}}
                            <li class="menu-item">
                                <a href="{{ route('shop') }}" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('cart') }}" class="link-term mercado-item-title">Cart</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('checkout') }}" class="link-term mercado-item-title">Checkout</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('contact') }}" class="link-term mercado-item-title">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
