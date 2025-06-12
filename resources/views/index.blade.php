<x-header />

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/hero/hero-1.png">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Offer Offer Offer</h6>
                                <h2>Massive Discount on Different Course</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                                <a href="{{URL::to('/shop')}}" class="primary-btn">Buy now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                                    <a href="https://x.com/"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
                                    <a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Get Your Course In Offer</h6>
                                <h2>Fall - Winter Collections 2030</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                                <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                                    <a href="https://x.com/"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
                                    <a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-1.png" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>ChatGPT Complete Guide: Learn<br> Midjourney</h2>
                            <a href="{{URL::to('/shop')}}">Buy now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-2.png" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Let's Learn Laravel: A Guided Path <br>For Beginners</h2>
                            <a href="{{URL::to('/shop')}}">Buy now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-3.png" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Adobe Premiere Pro CC Masterclass:<br> Video Editing in Premiere</h2>
                            <a href="{{URL::to('/shop')}}">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".sale">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @foreach($allProducts as $item)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{$item->type}}">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{URL::asset('uploads/profile/products/'.$item->picture)}}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <!-- <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                -->
                                <li><a href="{{URL::to('single/'.$item->id)}}"><img src="img/icon/compare.png" alt=""> <span>Product Details</span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$item->title}}</h6>
                            <a href="#" class="add-cart">{{$item->title}}</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>RS {{$item->price}}.00</h5>
                            <!-- <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div> -->
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Industry Expert<br /> <span>Course</span> <br /> Guidance</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>RS 1000</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Python Crash Course</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    {{-- <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                        <h3>#Male_Fashion</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End --> --}}

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                        <h2>New Trending Course 2024</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-1.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 16 July 2024</span>
                            <h5>Complete Generative AI Course With Langchain and Huggingface</h5>
                            <h6>*Complete Guide to Building, Deploying, and Optimizing Generative AI with Langchain and Huggingface</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-2.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 21 February 2024</span>
                            <h5>Machine Learning A-Z: AI, Python & R + ChatGPT Prize [2024]</h5>
                            <h6>Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.</h6>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-3.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 28 Aug 2020</span>
                            <h5>The Ultimate Public Relations Masterclass</h5>
                            <h6>Everything you need to know to be successful at PR in a digital (and AI-powered) world</h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
     

   <x-footer />

