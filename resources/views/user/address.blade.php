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
            @include('user.sidebar')  
            {{-- <div class="col-md-3">
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
            </div> --}}
            <div class="col-md-9">
                <div class="col-md-9">
                <div class="my-account-form-wrapper">
                    <h3>Billing address</h3>
                    <form action="{{route('user.address.store')}}" method="POST">
                        @csrf
                        {{-- <input type="hidden" value="{{$address->id}}" name="id" class="form-control"> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" value="{{$address?$address->fName : ''}}" name="first_name" class="form-control @error('fName') is-invalid @enderror">
                                    @error('fName')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" value="{{$address?$address->lName : ''}}" name="last_name" class="form-control @error('lName') is-invalid @enderror">
                                    @error('lName')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" value="{{$address?$address->company_name : ''}}" name="company_name" class="form-control @error('company_name') is-invalid @enderror">
                                    @error('company_name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label>Country / Region</label>
                                    <input type="text" name="country" value="{{$address->country}}" class="form-control">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Country / Region</label>
                                   <select name="country" value="{{$address?$address->country : ''}}" class="form-control @error('country') is-invalid @enderror">
                                            <option value="India">India</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="UK">UK</option>
                                            <option value="USA">USA</option>
                                        </select>
                                        @error('country')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div> 
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Street Address</label>
                                    <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{$address?$address->street : ''}}" placeholder="House number and street name">
                                    @error('street')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('house_no') is-invalid @enderror" name="house_no" value="{{$address?$address->house_no : ''}}" placeholder="Apartment, suite, unit, etc. (optional)">
                                    @error('house_no')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Town / City</label>
                                    <input type="text" name="city" value="{{$address?$address->city : ''}}" class="form-control @error('city') is-invalid @enderror">
                                    @error('city')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" value="{{$address->state}}" class="form-control">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" value="{{$address?$address->state : ''}}" class="form-control @error('state') is-invalid @enderror">
                                        <option value="West Bengal">West Bengal</option>
                                        <option value="Gujrat">Gujrat</option>
                                        <option value="Maharastra">Maharastra</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Hariana">Hariana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    </select>
                                    @error('state')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pin</label>
                                    <input type="number" name="pin_code" value="{{$address?$address->pin : ''}}" class="form-control @error('pin_code') is-invalid @enderror">
                                    @error('pin_code')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="mobile" value="{{$address?$address->phone : ''}}" class="form-control @error('mobile') is-invalid @enderror">
                                    @error('mobile')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror
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