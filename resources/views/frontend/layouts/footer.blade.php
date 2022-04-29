@php
$contactUs = App\Models\ContactUs::first();
// $principals = App\Models\Principal::get();
// $contactUs = $this->contactUsRepository->latestContactUs();
@endphp

<!-- ==================== Before Footer Section ==================== -->
    <section class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <h5>Call Us</h5>
                    {{-- <p>Sales - <a href="tel:9674759336">9674759336</a></p> --}}
                    <p>Sales - <a href="tel:9674759336">{{$contactUs->sales_phone}}</a></p>
                    <p>Support - <a href="tel:9674758730">{{$contactUs->support_phone}}</a></p>
                    {{-- <p>Support - <a href="tel:9674758730">9674758730</a></p> --}}
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <h5>Email Us At</h5>
                    <p>Email - <a href="mailto:info@filingrabbit.in">{{$contactUs->email}}</a></p>
                </div>
                <div class="col-sm-4">
                    <h5>Connect With Us</h5>
                    <ul class="social_links">
                        <li>
                            {{-- <a href="https://www.facebook.com/filingrabbit01" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a> --}}
                            <a href="{{$contactUs->facebook_link}}" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            {{-- <a href="https://twitter.com/filing_rabbit" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a> --}}
                            <a href="{{$contactUs->twitter_link}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            {{-- <a href="https://www.linkedin.com/company/filingrabbit" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a> --}}
                            <a href="{{$contactUs->instagram_link}}" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            {{-- <a href="https://www.instagram.com/filingrabbit/" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a> --}}
                            <a href="{{$contactUs->pinterest_link}}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            {{-- <a href="https://in.pinterest.com/filingrabbit" target="_blank">
                                <i class="fab fa-pinterest"></i>
                            </a> --}}
                            <a href="{{$contactUs->youtube_link}}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            {{-- <a href="https://www.youtube.com/channel/UCUlerUoNjflPjTxd9l1CatA" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a> --}}
                            <a href="https://www.youtube.com/channel/UCUlerUoNjflPjTxd9l1CatA" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Footer Section ==================== -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h4>Popular Services</h4>
                    <ul id="menu-legal-drafting-menu" class="">
                        <li>
                            <a href="#" class="nav-link">TradeMark Registration</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Copyright Registration</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Co-founder agreement</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Non-Disclosure Agreement for Third Party/Employee</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Service Level Agreement</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Website Policies Bundle</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Quick Links</h4>
                    <ul id="menu-footer-1" class="">
                        <li>
                            <a href="#" class="nav-link">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Refund Policy</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Disclaimer Policy</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">Confidentiality Statement</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Terms & Policies</h4>
                    <ul id="menu-quick-links" class="">
                        <li>
                            <a href="#" class="nav-link">About Us</a>
                        </li>
                        <li>
                            <a href="https://filingrabbit.in/blog/" class="nav-link">Blog</a>
                        </li>
                        <li>
                            <a href="https://filingrabbit.in/contact-us/" class="nav-link">Contact Us</a>
                        </li>
                        <li>
                            <a href="https://filingrabbit.in/cart/" class="nav-link">Cart</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Newsletter Subscription</h4>
                    <form action="#" class="tnp-subscription">
                        <input type="text" placeholder="Your name">
                        <input type="email" placeholder="Your email">
                        <input class="tnp-button" type="submit" value="Count me in!">
                    </form>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p>Copyright © 2021 Filing Rabbit</p>
                </div>
            </div>
        </div>
    </footer>
