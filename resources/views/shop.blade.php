@include('search')

    <style>
        .shop__nav__dropdown {
            margin-bottom: 20px;
        }
        .shop__nav__dropdown select {
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: white;
        }
        .shop__nav__dropdown select:focus {
            outline: none;
            border-color: #000;
        }

        /* Product Link Styles */
        .product-link {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .product-link:hover {
            color: #007bff;
            text-decoration: none;
        }
        .product__item__pic {
            transition: opacity 0.3s ease;
        }
        .product__item__pic:hover {
            opacity: 0.8;
        }
        
        /* Product Info Styles */
        .product__item__text {
            text-align: center;
            padding: 15px 10px;
        }
        .product__item__text h6 {
            display: none;
        }
        .product-info {
            margin-top: 10px;
        }
        .product-title {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
            line-height: 1.3;
        }
        .product-price {
            font-size: 18px;
            color: #007bff;
            font-weight: 600;
            margin-top: 5px;
        }
        .review-count {
            color: #666;
            font-size: 14px;
            margin: 5px 0;
        }
        .rating {
            margin-bottom: 5px;
        }
    </style>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{'/'}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <h5>Search</h5> <br>
                                <input type="search" name="search" placeholder="Search..." value="{{$search}}">
                                <button type="submit"><span class=""></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <!-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li><a href="#">Men (20)</a></li>
                                                    <li><a href="#">Women (20)</a></li>
                                                    <li><a href="#">Bags (20)</a></li>
                                                    <li><a href="#">Clothing (20)</a></li>
                                                    <li><a href="#">Shoes (20)</a></li>
                                                    <li><a href="#">Accessories (20)</a></li>
                                                    <li><a href="#">Kids (20)</a></li>
                                                    <li><a href="#">Kids (20)</a></li>
                                                    <li><a href="#">Kids (20)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- {{-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <li><a href="#">Louis Vuitton</a></li>
                                                    <li><a href="#">Chanel</a></li>
                                                    <li><a href="#">Hermes</a></li>
                                                    <li><a href="#">Gucci</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}} -->
                                <div class="card">
    <div class="card-heading">
        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
    </div>
    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
        <div class="card-body">
            <div class="shop__sidebar__price">
                <ul>
                    <li><a href="{{ url('shop?min_price=0&max_price=1000') }}">Rs0.00 - Rs1000.00</a></li>
                    <li><a href="{{ url('shop?min_price=1000&max_price=2000') }}">Rs50.00 - Rs2000.00</a></li>
                    <li><a href="{{ url('shop?min_price=3000&max_price=4000') }}">Rs2000.00 - Rs4000.00</a></li>
                    <li><a href="{{ url('shop?min_price=4000&max_price=5000') }}">Rs4000.00 - Rs5000.00</a></li>
                    <li><a href="{{ url('shop?min_price=5000&max_price=6000') }}">Rs5000.00 - Rs6000.00</a></li>
                    <li><a href="{{ url('shop?min_price=6000') }}">Rs6000.00+</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

                                <!-- {{-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="xs">xs
                                                    <input type="radio" id="xs">
                                                </label>
                                                <label for="sm">s
                                                    <input type="radio" id="sm">
                                                </label>
                                                <label for="md">m
                                                    <input type="radio" id="md">
                                                </label>
                                                <label for="xl">xl
                                                    <input type="radio" id="xl">
                                                </label>
                                                <label for="2xl">2xl
                                                    <input type="radio" id="2xl">
                                                </label>
                                                <label for="xxl">xxl
                                                    <input type="radio" id="xxl">
                                                </label>
                                                <label for="3xl">3xl
                                                    <input type="radio" id="3xl">
                                                </label>
                                                <label for="4xl">4xl
                                                    <input type="radio" id="4xl">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}} -->
                                <!-- {{-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                <label class="c-1" for="sp-1">
                                                    <input type="radio" id="sp-1">
                                                </label>
                                                <label class="c-2" for="sp-2">
                                                    <input type="radio" id="sp-2">
                                                </label>
                                                <label class="c-3" for="sp-3">
                                                    <input type="radio" id="sp-3">
                                                </label>
                                                <label class="c-4" for="sp-4">
                                                    <input type="radio" id="sp-4">
                                                </label>
                                                <label class="c-5" for="sp-5">
                                                    <input type="radio" id="sp-5">
                                                </label>
                                                <label class="c-6" for="sp-6">
                                                    <input type="radio" id="sp-6">
                                                </label>
                                                <label class="c-7" for="sp-7">
                                                    <input type="radio" id="sp-7">
                                                </label>
                                                <label class="c-8" for="sp-8">
                                                    <input type="radio" id="sp-8">
                                                </label>
                                                <label class="c-9" for="sp-9">
                                                    <input type="radio" id="sp-9">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}} -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <a href="#">Online Course</a>
                                                <a href="#">AI</a>
                                                <a href="#">Coding</a>
                                                <a href="#">Programming</a>
                                                <a href="#">Video Editing</a>
                                                <a href="#">Adobe</a>
                                                <a href="#">Youtube Cource</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    @if($category)
                                    <p>Showing Products in {{$category}} Category</p>
                                    @else
                                    <p>Showing All Products</p>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    {{-- <div class="row">
                        @foreach($allProducts as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 {{$item->type}}">
                            <div class="product__item">

                                <div class="product__item__pic set-bg" data-setbg="{{URL::asset('uploads/profile/products/'.$item->picture)}}">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="{{URL::to('single/'.$item->id)}}"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$item->title}}</h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{$item->price}}</h5>
                                    <div class="product__color__select">
                                        <label for="pc-4">
                                            <input type="radio" id="pc-4">
                                        </label>
                                        <label class="active black" for="pc-5">
                                            <input type="radio" id="pc-5">
                                        </label>
                                        <label class="grey" for="pc-6">
                                            <input type="radio" id="pc-6">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div> --}}
                     @if($filteredProducts->isEmpty())
                    <p class="no-products-message">No products available.</p>
                  @else
                  <div class="row product__filter">
    @foreach($filteredProducts as $item)
    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{$item->type}}">
        <div class="product__item">
            <a href="{{URL::to('single/'.$item->id)}}">
            <div class="product__item__pic set-bg" data-setbg="{{URL::asset('uploads/profile/products/'.$item->picture)}}">
                <span class="label">New</span>
            </div>
            </a>
            <div class="product__item__text">
                <h5 class="product-title">{{ $item->title }}</h5>
                <h5 class="product-price">RS {{ $item->price }}.00</h5>
                <div class="rating">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < round($item->averageRating))
                            <i class="fa fa-star text-warning"></i>
                        @else
                            <i class="fa fa-star-o text-secondary"></i>
                        @endif
                    @endfor
                </div>
                <p class="review-count">{{ $item->totalReviews }} reviews</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

                    @endif
                    </div>


                  
                </div>
            </div>
            {{$filteredProducts->links()}}
        </div>
    </section>
    <!-- Shop Section End -->

   <x-footer/>
