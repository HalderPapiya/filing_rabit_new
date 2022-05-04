@extends('frontend.layouts.master')
@section('content')
<!-- ==================== Banner Section ==================== -->
<section class="banner-area cart-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2 data-aos="fade-down" data-aos-duration="1000">Dashboard</h2>
                    <div class="shadow_text">Filingrabbit</div>
                </div>
                <a href="#" class="home">Home</a> / <span>My Account</span>
            </div>
        </div>
    </div>
</section>

<!-- ==================== Account Section ==================== -->
<section class="ac_section">
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                <nav class="sticky-top my-account-navigation">
                    <ul>
                        <li class="active">
                            <a href="dashboard.html">Dashboard</a>
                        </li>
                        <li>
                            <a href="orders.html">Orders</a>
                        </li>
                        <li>
                            <a href="downloads.html">Downloads</a>
                        </li>
                        <li>
                            <a href="address.html">Addresses</a>
                        </li>
                        <li>
                            <a href="account-details.html">Account Details</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9">
                <div class="view-cart-message d-flex align-items-center justify-content-between">
                    <p>
                        Hello <strong>aasim</strong> (not <strong>aasim</strong>? 
                        <a href="#">Log out</a>)
                    </p>
                    <p>
                        From your account dashboard you can view your 
                        <a href="#">recent orders</a>, 
                        manage your 
                        <a href="#">shipping and billing addresses</a>, 
                        and 
                        <a href="#">edit your password and account details</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection