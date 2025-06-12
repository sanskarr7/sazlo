<x-header />


<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 mx-auto">
                <div class="section-title">

                    <h2>My Account</h2>

                </div>
                <div class="contact__form">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        <p>
                            {{session()->get('success')}}
                        </p>

                    </div>
                    @endif
                    <img src="{{URL::asset('uploads/profile/'.$user->picture)}}" class="mx-auto d-block mb-2" width="200px">
                    <form action="{{url('updateUser')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="fullname" placeholder="Name" value="{{$user->fullname}}" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="email" placeholder="Email" value="{{$user->email}}" readonly required>
                            </div>
                            <div class="col-lg-6">
                                <input type="file" name="file" >
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="password" placeholder="Password" value="{{$user->password}}" required>
                            </div>
                            <div class="col-lg-12">

                                <button type="submit" name="register" class="site-btn">Save Changes</button>
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
