<x-header />
<!-- Shop Details Section Begin -->
<section class="shop-details">
        <div class="container">
        <div class="product__details__breadcrumb mb-5">
                        <a href="{{'/'}}">Home</a>
            <a href="{{'/shop'}}">Shop</a>
                        <span>Product Details</span>
                    </div>

        <div class="row">
            <!-- Left Column - Product Images -->
            <div class="col-lg-6">
                <div class="product-main-image mb-4">
                    <img src="{{url('uploads/profile/products/'.$product->picture)}}" alt="{{$product->title}}" class="img-fluid main-image">
                </div>
                <div class="product-thumbnails d-flex justify-content-start">
                    <div class="thumbnail-item">
                        <img src="{{url('uploads/profile/products/'.$product->picture)}}" alt="Thumbnail 1" class="img-fluid thumbnail active">
            </div>
                    <div class="thumbnail-item">
                        <img src="{{url('uploads/profile/products/'.$product->picture2)}}" alt="Thumbnail 2" class="img-fluid thumbnail">
                                </div>
                    <div class="thumbnail-item">
                        <a href="{{url('uploads/videos/'.$product->video2)}}" class="video-thumbnail">
                            <img src="{{url('uploads/profile/products/'.$product->picture)}}" alt="Video Thumbnail" class="img-fluid thumbnail">
                            <div class="play-icon">
                                    <i class="fa fa-play"></i>
                                </div>
                            </a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Product Details -->
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h2 class="product-title">{{$product->title}}</h2>

                    <div class="rating-section">
                        <div class="d-flex align-items-start">
                            <div class="star-rating me-3">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < round($averageRating))
                                        <i class="fa fa-star text-warning"></i>
                                    @else
                                        <i class="fa fa-star-o text-secondary"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-count">({{$totalReviews}} Reviews)</span>
                        </div>
                    </div>

                    <div class="price-section">
                        <h3 class="price">RS {{$product->price}}.00</h3>
                </div>

                    <div class="description-section">
                        <p class="description">{{$product->description}}</p>
            </div>

                  <!-- Replace the existing form section with this code -->
@php
    // Check if product is already in cart
    $inCart = false;
    if(auth()->check()) {
        $inCart = \App\Models\Cart::where('customerId', auth()->id())
                       ->where('productId', $product->id)
                       ->exists();
    }
@endphp

@if($inCart)
    <div class="product__details__cart__option">
        <button type="button" class="primary-btn" disabled>
            <i class="fas fa-check-circle me-2"></i> Already in Cart
        </button>
        <a href="{{ route('cart.view') }}" class="btn btn-outline-dark">
            <i class="fas fa-shopping-cart me-2"></i> View Cart
        </a>
    </div>
@else
    <form action="{{url('addToCart')}}" method="POST" class="mb-4">
        @csrf
        <div class="product__details__cart__option">
            <div class="quantity">
                <input type="number" name="quantity" class="form-control quantity-input"
                       min="1" max="{{$product->quantity}}" value="1">
            </div>
            <input type="hidden" name="id" value="{{$product->id}}" />
            <button type="submit" name="addToCart" class="primary-btn">
                <i class="fas fa-cart-plus me-2"></i> Add to Cart
            </button>
        </div>
    </form>
@endif

                    <div class="product-meta">
                        <ul class="list-unstyled">
                            <li class="d-flex"><div class="meta-label">SKU:</div><div class="meta-value">3812912</div></li>
                            <li class="d-flex"><div class="meta-label">Categories:</div><div class="meta-value">{{$product->category}}</div></li>
                            <li class="d-flex"><div class="meta-label">Tags:</div><div class="meta-value">Course, OCS, Barcob</div></li>
                    </ul>
            </div>
        </div>
    </div>
</div>

        <!-- Additional Information Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer Reviews ({{$totalReviews}})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">{{$product->description}}</p>
                                    <div class="product__details__tab__content__item">
                                        <h5><span style="color: brown">More Information</span></h5>
                                        <p>{{$product->ex_description}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                            <!-- Review Form -->
                            <div class="review-form-section mb-5">
                                    <h3 class="h4 pb-3">Write a Review</h3>
                                    <form action="{{ route('front.saveRating', ['productId' => $product->id]) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                                @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="rating">
                                            @for($i = 5; $i >= 1; $i--)
                                            <input id="rating-{{$i}}" type="radio" name="rating" value="{{$i}}" required>
                                            <label for="rating-{{$i}}" class="rating-label"><i class="fas fa-star"></i></label>
                                            @endfor
                                            </div>
                                            @error('rating')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                        <textarea name="comment" class="form-control" rows="5" placeholder="Your Review" required></textarea>
                                            @error('comment')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    <button type="submit" class="btn btn-dark">Submit Review</button>
                                    </form>
                                    </div>

                                    <!-- Reviews Display -->
                            <div class="reviews-section">
                                <h3 class="h4 mb-4">Customer Reviews</h3>
                                        @foreach($reviews as $review)
                                <div class="review-item mb-4 p-4 bg-light rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">{{ $review->name }}</h5>
                                        <div class="star-rating">
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $review->rating)
                                                    <i class="fa fa-star text-warning"></i>
                                                @else
                                                    <i class="fa fa-star-o"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $review->comment }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.main-image {
    width: 85%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
    display: block;
    margin-left: 0;
}

.product-thumbnails {
    gap: 15px;
    width: 85%;
}

.thumbnail-item {
    width: 30%;
}

.thumbnail {
    width: 100%;
    height: auto;
        border-radius: 4px;
    cursor: pointer;
    transition: opacity 0.3s ease;
    }

.thumbnail:hover {
    opacity: 0.8;
}

.thumbnail.active {
    border: 2px solid #007bff;
    }

/* Video Thumbnail Styles */
.video-thumbnail {
    position: relative;
    display: block;
    }

.play-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0, 0, 0, 0.7);
    width: 40px;
    height: 40px;
    border-radius: 50%;
        display: flex;
    align-items: center;
    justify-content: center;
    }

.play-icon i {
    color: white;
}

/* Product Details Styling */
.product__details__text {
    padding-left: 20px;
    padding-top: 0;
    text-align: left;
    }

.product-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #333;
    margin-top: 0;
    margin-bottom: 1rem;
    text-align: left;
    line-height: 1.2;
}

.rating-section {
    margin-bottom: 1rem;
    text-align: left;
    }

.price-section {
    margin-bottom: 1rem;
    text-align: left;
}

.price {
        font-size: 1.5rem;
    color: #007bff;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-align: left;
    }

.description-section {
    margin-bottom: 1.5rem;
    text-align: left;
}

.description {
    color: #666;
    line-height: 1.5;
    margin-bottom: 1rem;
    text-align: justify;
    }

/* Cart Section */
.product__details__cart__option {
    margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    gap: 15px;
    }

.quantity {
    width: 120px;
}

.quantity-input {
    height: 45px;
    text-align: center;
    font-size: 15px;
        border: 1px solid #ddd;
    border-radius: 4px;
    padding: 0 10px;
    width: 100%;
    line-height: 45px;
    }

.primary-btn {
    height: 45px;
    padding: 0 30px;
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-flex;
        align-items: center;
    justify-content: center;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
    line-height: 45px;
    }

.primary-btn:hover {
    background: #333;
}

/* Product Meta */
.product-meta {
    border-top: 1px solid #eee;
    padding-top: 1rem;
    margin-top: 1.5rem;
    text-align: left;
    }

.product-meta li {
    margin-bottom: 0.5rem;
    color: #666;
    }

.meta-label {
    font-weight: 600;
        color: #333;
    width: 100px;
}

.meta-value {
    color: #666;
}

/* Remove secure checkout section */
.secure-checkout {
    display: none;
    }

/* Responsive Styles */
@media (max-width: 768px) {
    .main-image {
        width: 95%;
    }

    .product-thumbnails {
        width: 95%;
    }

    .thumbnail-item {
        width: 30%;
    }

    .product-title {
        font-size: 1.5rem;
        margin-top: 1rem;
    }

    .price {
        font-size: 1.3rem;
    }

    .meta-label {
        width: 80px;
    }

    .product__details__text {
        padding-left: 15px;
        padding-top: 1rem;
    }

    .quantity {
        width: 100px;
    }

    .primary-btn {
        padding: 0 20px;
        font-size: 14px;
    }

    .quantity-input,
    .primary-btn {
        height: 40px;
        line-height: 40px;
    }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thumbnail click handling
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('.main-image');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            // Add active class to clicked thumbnail
            this.classList.add('active');
            // Update main image if it's not a video thumbnail
            if (!this.parentElement.classList.contains('video-thumbnail')) {
                mainImage.src = this.src;
            }
        });
    });
});
</script>

<x-footer/>
