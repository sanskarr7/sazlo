<x-adminheader />
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome Barcobe Admin</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg" style="position: relative; overflow: hidden; width: 550px; height: 247px;">
    <div class="card-people mt-auto" style="position: relative; z-index: 1; width: 100%; height: 100%;">
        <video 
            src="Dashboard/images/dashboard/video.mp4" 
            autoplay 
            muted 
            loop 
            style="
                position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                object-fit: cover; 
                z-index: -1;
            "
        ></video>
        
    </div>
</div>

<div class="col-md-12 grid-margin transparent">
    <div class="row">
        <div class="col-md-6 mb-5 ">
            <a href="{{ URL::to('adminProducts') }}" class="text-decoration-none">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Product</p>
                        <p class="fs-30 mb-2">{{ $totalProducts }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 mb-4 ">
            <a href="{{ URL::to('reviews') }}" class="text-decoration-none">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Reviews</p>
                        <p class="fs-30 mb-2">{{ $totalReviews }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 ">
            <a href="{{ URL::to('ourOrders') }}" class="text-decoration-none">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Order</p>
                        <p class="fs-30 mb-2">{{ $totalOrders }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 ">
            <a href="{{ URL::to('ourCustomers') }}" class="text-decoration-none">
                <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">Number of User</p>
                        <p class="fs-30 mb-2">{{ $totalUsers }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

        </div>
       
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <x-adminfooter />
    </div>
</div>
