-@extends('frontend.layouts.master')
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
            {{-- @if($ipWiseOrders)
            <div class="col-md-9">
                @if(count($ipWiseOrders)<1)
                    <div class="view-cart-message d-flex align-items-center justify-content-between">
                        <p>
                            <i class="fa fa-check-circle"></i>
                            No order has been made yet.
                        </p>
                        <a href="#" class="btn btn-warning">Browse Products</a>
                    </div>  
                @else
                <div class="row">
                    @foreach ($ipWiseOrders as $key => $order)
                        <div class="col-md-6 mb-3 dash-card-col">
                            <div class="card card-body mb-0">

                                <h5 class="mb-2">{{$order->order_no ? $order->order_no: ''}}</h5>
                                @foreach ($order->orderProduct as $orderProduct)
                                       <h5 class="mb-2">{{$orderProduct->productDetails ? $orderProduct->productDetails->name: ''}}</h5>
                                @endforeach
                                
                                </p>
                               
                            </div>
                        </div>    
                    @endforeach
                </div>
                @endif

            </div>
            @else --}}
            
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
                    @foreach ($orders as $key => $order)
                        <div class="col-md-6 mb-3 dash-card-col">
                            <div class="card card-body mb-0 shadow-sm border-0">
                                {{-- {{($loop->first ? '' : ', ').($order->order_no ? $order->order_no: '') . ' ' .($order->productDetails->name ? $order->productDetails->name: '')}} --}}
                                {{-- @php if ($key == 2) {echo '...';break;} @endphp --}}
           
                                <a href="{{ route('user.order.details', $order['id']) }}">
                                    <h5 class="mb-2">{{$order->order_no ? $order->order_no: ''}}</h5>
                                    <p class="mb-0">Price : {{$order->amount}}/-</p>
                                    @if($order->status == 1)
                                    <p class="mb-0"><small>Order Status: <b>New</b></small></p>
                                    @elseif($order->status == 2)
                                    <p class="mb-0"><small>Order Status: <b>Confirm</b></small></p>
                                    @elseif($order->status == 3)
                                    <p class="mb-0"><small>Order Status: <b>Shipped</b></small></p>
                                    @elseif($order->status == 4)
                                    <p class="mb-0"><small>Order Status: <b>Delivered</b></small></p>
                                    @elseif($order->status == 5)
                                    <p class="mb-0"><small>Order Status: <b>Canceled</b></small></p>
                                    @endif
                                </a>
                                @if(!($order->status == 5))
                                <a href="{{ route('user.order.cancel', $order['id']) }}">Cancel</a>
                                @elseif($order->status == 5)
                                <p class="mb-0"><small>Your Order is Canceled .</small></p>
                                @endif
                                {{-- @foreach ($order->orderProduct as $orderProduct)
                                       <h5 class="mb-2">{{$orderProduct->productDetails ? $orderProduct->productDetails->name: ''}}</h5>
                                @endforeach --}}
                                {{-- <h5 class="mb-2">{{$order->productDetails->name ? $order->productDetails->name: ''}}</h5> --}}
                                {{-- <p class="small mb-0"> --}}
                                
                                </p>
                                {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                            </div>
                        </div>    
                    @endforeach
                </div>
                @endif

            </div>
            
            {{-- @endif --}}
        </div>
    </div>
</section>
@endsection