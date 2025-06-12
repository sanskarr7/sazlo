<x-header />


<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 mx-auto">
                <div class="section-title">

                    <h2>Login</h2>

                </div>
                <div class="contact__form">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            <p>
                                {{session()->get('success')}}
                            </p>

                        </div>
                        @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        <p>
                            {{session()->get('error')}}
                        </p>

                    </div>
                    @endif

                    <form action="{{url('/loginUser')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-12">
                                <input type="text" name="email" placeholder="Email" required>
                            </div>

                            <div class="col-lg-12">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-lg-12">

                                <button type="submit" name="login" class="site-btn">Login </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<x-footer />
