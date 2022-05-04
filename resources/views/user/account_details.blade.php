@extends('frontend.layouts.master')
@section('content')
 <!-- ==================== Banner Section ==================== -->
 <section class="banner-area cart-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2 data-aos="fade-down" data-aos-duration="1000">Account Details</h2>
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
                        <li>
                            <a href="address.html">Addresses</a>
                        </li>
                        <li class="active">
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
                    <form action="{{route('change-password')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" value="{{$data->first_name}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" value="{{$data->last_name}}" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label>Display Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email"  value="{{$data->email}}"  class="form-control">
                                </div>
                            </div>

                           
                        


                            <div class="col-12">
                                <h3>Password Change</h3>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Current Password (leave blank to leave unchanged)</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>New Password (leave blank to leave unchanged)</label>
                                    <input type="password" name="new_password"  class="form-control @error('new_password') is-invalid @enderror">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn ur-submit-button w-auto">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection