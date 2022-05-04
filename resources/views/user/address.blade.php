@extends('frontend.layouts.master')
@section('content')
<!-- ==================== Banner Section ==================== -->
<section class="banner-area cart-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2 data-aos="fade-down" data-aos-duration="1000">Addresses</h2>
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
                        <li>
                            <a href="dashboard.html">Dashboard</a>
                        </li>
                        <li>
                            <a href="orders.html">Orders</a>
                        </li>
                        <li>
                            <a href="downloads.html">Downloads</a>
                        </li>
                        <li class="active">
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
                <div class="my-account-form-wrapper">
                    <h3>Billing address</h3>
                    <form action="{{route('address.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Country / Region</label>
                                    <input type="text" name="country" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label>Country / Region</label>
                                    <select class="form-control">
                                        <option value="">India</option>
                                        <option value="">India</option>
                                        <option value="">India</option>
                                        <option value="">India</option>
                                        <option value="">India</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Street Address</label>
                                    <input type="text" class="form-control" name="street" placeholder="House number and street name">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Town / City</label>
                                    <input type="text" name="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control">
                                        <option value="">West Bengal</option>
                                        <option value="">West Bengal</option>
                                        <option value="">West Bengal</option>
                                        <option value="">West Bengal</option>
                                        <option value="">West Bengal</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pin</label>
                                    <input type="number" name="pin_code" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="mobile" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn ur-submit-button w-auto">Save Address</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection