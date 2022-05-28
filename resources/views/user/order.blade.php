@extends('frontend.layouts.master')
@section('content')
<section class="banner-area cart-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2 data-aos="fade-down" data-aos-duration="1000">Orders</h2>
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
            {{-- <div class="col-md-3"> --}}
                {{-- <nav class="sticky-top my-account-navigation">
                    <ul>
                        <li>
                            <a href="dashboard.html">Dashboard</a>
                        </li>
                        <li class="active">
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
                </nav> --}}
            {{-- </div> --}}
            
            <div class="col-md-9">
                @if(count($orders)<1)
                    <div class="view-cart-message d-flex align-items-center justify-content-between">
                        <p>
                            <i class="fa fa-check-circle"></i>
                            No order has been made yet.
                        </p>
                        <a href="#" class="btn btn-warning">Browse Products</a>
                    </div>  
                @else
                <div class="row">
                    @foreach ($orders as $order)
                        <div class="col-md-6 mb-3 dash-card-col">
                            <div class="card card-body mb-0">
                                <h5 class="mb-2">{{$order->order_no ? $order->order_no: ''}}</h5>
                                <h5 class="mb-2">{{$order->productDetails->name ? $order->productDetails->name: ''}}</h5>
                                {{-- <p class="small mb-0"> --}}
                                
                                </p>
                                {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                            </div>
                        </div>    
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection