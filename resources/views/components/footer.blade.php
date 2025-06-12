 <!-- Footer Section Begin -->
 <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{URL::asset('img/footer-logo.png')}}" alt=""></a>
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    <a href="#"><img src="{{URL::asset('img/payment.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="{{URL::to('/login')}}">Login</a></li>
                        <li><a href="{{URL::to('/shop')}}">Course</a></li>
                        <li><a href="{{URL::to('/cart')}}">Shopping Cart</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="{{url('/contactus')}}">Contact Us</a></li>
                        <li><a href="#">Payment Methods</a></li>
                        <li><a href="#">Delivary</a></li>
                        <li><a href="#">Return & Exchanges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>About Us</h6>
                    <div class="footer__newslatter">
                        <p>Welcome to Barcob, your go-to destination for high-quality courses designed to elevate your skills and knowledge. At Barcob, we are passionate about empowering learners with a diverse range of educational resources!</p>
                        <p>Phone Number : +977 9748274572
                        Email : sanskarsatyal19@gmail.com
                        </p>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>2020
                        All rights reserved | This Website is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Sanskar</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
 <!-- Search Begin -->
 <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{URL::asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.nice-select.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.nicescroll.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.countdown.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.slicknav.js')}}"></script>
<script src="{{URL::asset('js/mixitup.min.js')}}"></script>
<script src="{{URL::asset('js/owl.carousel.min.js')}}"></script>
<script src="{{URL::asset('js/main.js')}}"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/66b88bc5146b7af4a438f503/1i50e3v6d';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>
