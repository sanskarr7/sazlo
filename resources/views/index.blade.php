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
   <style>
    .banner-section {
        background: linear-gradient(to right, #f8f9fc, #eef1f7);
        padding: 80px 0;
    }

    .banner-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .banner-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .banner-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .banner-content {
        padding: 24px;
        flex-grow: 1;
    }

    .banner-content h4 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #2c3e50;
    }

    .banner-content p {
        font-size: 15px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .banner-content a {
        text-decoration: none;
        background-color: #0056d2;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .banner-content a:hover {
        background-color: #003f9f;
    }

    @media (max-width: 767px) {
        .banner-card img {
            height: 180px;
        }
    }
</style>

<section class="banner-section">
    <div class="container">
        <h3 style="padding: 20px">Shop By Category</h3>
        <div class="row g-4" id="category-row" >
            @foreach($categories as $index => $category)
    @php
        $productImage = \App\Models\Product::where('category', $category->name)->value('picture');
        $categoryImage = $category->image
            ? asset('uploads/category/' . $category->image)
            : ($productImage
                ? asset('uploads/profile/products/' . $productImage)
                : asset('img/placeholder.png'));
    @endphp

    <div class="col-lg-4 col-md-6 category-card {{ $index > 2 ? 'd-none extra-category' : '' }}">
        <div class="banner-card glass-card">
            <img src="{{ $categoryImage }}" alt="{{ $category->name }}" class="img-fluid">
            <div class="banner-content">
                <h4>{{ $category->name }}</h4>
                <p>Explore our top courses in the {{ $category->name }} category.</p>
                <a href="{{ URL::to('/shop?category=' . urlencode($category->name)) }}">Explore Now</a>
            </div>
        </div>
    </div>
@endforeach

        </div>
        @if(count($categories) > 3)

            <div class="text-center mt-4">
                <button class="btn btn-glass" id="toggleViewBtn" onclick="toggleCategories()">View More</button>
            </div>
        @endif
    </div>
</section>

<script>
    function toggleCategories() {
        const extraCards = document.querySelectorAll('.extra-category');
        const toggleBtn = document.getElementById('toggleViewBtn');

        extraCards.forEach(card => {
            card.classList.toggle('d-none');
        });

        if (toggleBtn.innerText === 'View More') {
            toggleBtn.innerText = 'View Less';
        } else {
            toggleBtn.innerText = 'View More';
        }
    }
</script>

<style>
    .banner-section {
        background: linear-gradient(to right, #f4f6f9, #eaeef3);
        padding: 80px 0;
    }
.category-card {
    margin-bottom: 30px; /* Adjust the value as needed */
}

    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 24px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .glass-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
    }

    .glass-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 24px;
        border-top-right-radius: 24px;
    }

    .banner-content {
        padding: 24px;
        text-align: center;
    }

    .banner-content h4 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .banner-content p {
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
    }

    .banner-content a {
        display: inline-block;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 12px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .banner-content a:hover {
        background: rgb(59, 10, 43);
    }

    .btn-glass {
        padding: 10px 24px;
        border: none;
        background: rgba(0, 123, 255, 0.2);
        color: #000000;
        font-weight: 600;
        border-radius: 20px;
        backdrop-filter: blur(8px);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-glass:hover {
        background: rgba(0, 123, 255, 0.4);
    }
</style>




    <!-- Banner Section End -->

    <!-- Product Section Begin -->
   <style>
    .glass-product-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        backdrop-filter: blur(5px);
    }

    .glass-filter-controls {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 50px;
        flex-wrap: wrap;
    }

    .glass-filter-btn {
        padding: 10px 24px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.2);
        color: #333;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .glass-filter-btn.active,
    .glass-filter-btn:hover {
        background: rgba(255, 255, 255, 0.6);
        color: #000000;
    }

    .glass-product-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .glass-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
    }

    .glass-product-img {
        height: 240px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .glass-label {
        position: absolute;
        top: 16px;
        left: 16px;
        background: rgba(255, 69, 100, 0.85);
        color: white;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .glass-actions {
        position: absolute;
        bottom: 12px;
        right: 12px;
    }

    .glass-actions a {
        text-decoration: none;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 8px 14px;
        font-size: 12px;
        border-radius: 20px;
        transition: all 0.2s ease;
    }

    .glass-actions a:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .glass-product-body {
        padding: 20px;
        color: #1f2937;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .glass-product-body h5 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .glass-product-body .add-cart {
        font-size: 14px;
        color: #0056d2;
        text-decoration: none;
        font-weight: 500;
        margin-top: 8px;
    }

    .glass-product-body .price {
        font-size: 18px;
        font-weight: 700;
        margin-top: 10px;
    }

    .rating i {
        color: #fbbc05;
        font-size: 14px;
    }
</style>

<section class="glass-product-section">
    <div class="container">
        <!-- Filters -->
        <div class="glass-filter-controls">
            <span class="glass-filter-btn active" data-filter="*">Best Sellers</span>
            <span class="glass-filter-btn" data-filter=".new-arrivals">New Arrivals</span>
            <span class="glass-filter-btn" data-filter=".sale">Hot Sales</span>
        </div>

        <!-- Products Grid -->
        <div class="row product__filter">
            @foreach($allProducts as $item)
                <div class="col-lg-3 col-md-6 col-sm-6 mix {{ $item->type }}">
                    <div class="glass-product-card">
                        <div class="glass-product-img" style="background-image: url('{{ URL::asset('uploads/profile/products/' . $item->picture) }}');">
                            <span class="glass-label">New</span>
                            <div class="glass-actions">
                                <a href="{{ URL::to('single/' . $item->id) }}">View Details</a>
                            </div>
                        </div>
                        <div class="glass-product-body">
                            <h5>{{ $item->title }}</h5>
                            <a href="#" class="add-cart">{{ $item->title }}</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="price">Rs {{ $item->price }}.00</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    {{-- <section class="categories spad">
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
    </section> --}}
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
        <div class="section-title text-center mb-5">
            <span>Latest News</span>
            <h2>New Trending Courses 2024</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item glass-card">
                    <div class="blog__item__pic" style="background-image: url('img/blog/blog-1.jpg');"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt="calendar icon" /> 16 July 2024</span>
                        <h5>Complete Generative AI Course With Langchain and Huggingface</h5>
                        <p>Complete Guide to Building, Deploying, and Optimizing Generative AI with Langchain and Huggingface</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item glass-card">
                    <div class="blog__item__pic" style="background-image: url('img/blog/blog-2.jpg');"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt="calendar icon" /> 21 February 2024</span>
                        <h5>Machine Learning A-Z: AI, Python & R + ChatGPT Prize [2024]</h5>
                        <p>Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item glass-card">
                    <div class="blog__item__pic" style="background-image: url('img/blog/blog-3.jpg');"></div>
                    <div class="blog__item__text">
                        <span><img src="img/icon/calendar.png" alt="calendar icon" /> 28 Aug 2020</span>
                        <h5>The Ultimate Public Relations Masterclass</h5>
                        <p>Everything you need to know to be successful at PR in a digital (and AI-powered) world.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.latest {
    padding: 80px 0;
    background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
}

.section-title span {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #d10909;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 1.2px;
}

.section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1f2937;
}

.blog__item {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    backdrop-filter: blur(12px);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.blog__item:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.15);
}

.blog__item__pic {
    height: 220px;
    background-size: cover;
    background-position: center;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.blog__item__text {
    padding: 20px;
    color: #1f2937;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.blog__item__text span {
    display: flex;
    align-items: center;
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 10px;
    gap: 6px;
}

.blog__item__text span img {
    width: 16px;
    height: 16px;
}

.blog__item__text h5 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #111827;
}

.blog__item__text p {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.5;
}

/* Responsive tweak for smaller screens */
@media (max-width: 767px) {
    .blog__item__pic {
        height: 180px;
    }
    .section-title h2 {
        font-size: 26px;
    }
}
</style>

    <!-- Latest Blog Section End -->


   <x-footer />

