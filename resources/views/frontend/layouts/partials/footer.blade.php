@php
    $config = \App\Models\ConfigProject::where('status', \App\Enums\ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
@endphp
<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                @if(!$config->isEmpty())
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img class="img" src="{{ asset('storage/'.$config[0]->logo) }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: {{$config[0]->address}}.</li>
                            <li>Phone: {{$config[0]->phone}}</li>
                            <li>Email: {{$config[0]->email}}</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-share"></i></a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-2 offset-lg-1 col-sm-6">
                <div class="footer-widget">
                    <h5>Information</h5>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="footer-widget">
                    <h5>My Account</h5>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="#">Shop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="newslatter-item">
                    <h5>Join Our Newsletter Now</h5>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#" class="subscribe-form">
                        <input type="text" placeholder="Enter Your Mail">
                        <button type="button">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="copyright-text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" ></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="payment-pic">
                        <img class="img" src="{{asset('images/img/payment-method.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->