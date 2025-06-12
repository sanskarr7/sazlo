<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcob</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}" type="text/css">
    

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Easy</a>
                                <a href="#">To</a>
                            </div>
            <div class="offcanvas__top__hover">
                                <span>Use</span>
                        </div>
                    </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{URL::asset('img/icon/search.png')}}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap">
            <nav class="header__menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{URL::to('/')}}">Home</a></li>
                    <li><a href="#">Shop</a>
                        <ul class="dropdown">
                            @foreach($categories as $category)
                            <li><a href="{{URL::to('/shop?category='.$category->name)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            <li><a href="{{URL::to('/cart')}}">Shopping Cart</a></li>
                            <li><a href="{{URL::to('/profile')}}">My Account</a></li>
                            <li><a href="{{URL::to('myOrders')}}">My Orders</a></li>
                        </ul>
                    </li>
                    @if(session()->has('id'))
                    <li><spam>{{ session()->get('fullname') }}
                        <ul class="dropdown">
                            <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
                        </ul></spam>
                    </li>
                    @else
                    <li><a href="{{URL::to('/login')}}">Login</a></li>
                    <li><a href="{{URL::to('/register')}}">Register</a></li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Welcome To Barcob. We Sell Different Course</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#"> Easy</a>
                                <a href="#">To</a>
                            </div>
                            <div class="header__top__hover">
                                <span>Use</span>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="{{URL::asset('img/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{URL::to('/')}}">Home</a></li>
                            <li><a href="{{URL::to('/shop')}}">Shop</a>
                                <ul class="dropdown">
                                    @foreach($categories as $category)
                                    <li><a href="{{URL::to('/shop?category='.$category->name)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    {{-- <li><a href="./about.html">About Us</a></li> --}}
                                    {{-- <li><a href="./shop-details.html">Shop Details</a></li> --}}
                                    <li><a href="{{URL::to('/cart')}}">Shopping Cart</a></li>
                                    
                                    <li><a href="{{URL::to('/profile')}}">My Account</a></li>
                                    <li><a href="{{URL::to('myOrders')}}">My Orders</a></li> 
                                </ul>
                            </li>
                            <a>
                            @if(session()->has('id'))
                            <li><spam >{{ session()->get('fullname') }}
                                <ul class="dropdown">
                                    <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
                                </ul></spam>
                            </li> <!-- Display the user's name -->
                            @else
                            <li><a href="{{URL::to('/login')}}">Login</a></li>
                            <li><a href="{{URL::to('/register')}}">Register</a></li>
                            @endif
                        </ul>
                    </a>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="header__nav__option">
                  
                    <form action="" class="col-20">
    <div class="form-group d-flex">
        <input type="search" name="search" id="" class="form-control mt-1" placeholder="Search" value="{{$search}}">
        <button class="btn btn-dark ml-2 mt-1 text-white">Search</button>
       <a href="{{url('/shop')}}">
       <button class="btn btn-dark ml-2 mt-1 text-white" type="button">Reset</button>
       </a>
    </div>
</form>

                       
                        <!-- <a href="#"><img src="{{URL::asset('img/icon/heart.png')}}" alt=""></a>
                        <a href="#"><img src="{{URL::asset('img/icon/cart.png')}}" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div> -->
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
