{{-- @php echo $orderProducts; exit; @endphp --}}


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
           
            <div class="col-md-9">
                @if(count($orderProducts)<0)
                    <div class="view-cart-message d-flex align-items-center justify-content-between">
                        <p>
                            <i class="fa fa-check-circle"></i>
                            No order has been made yet.
                        </p>
                        <a href="#" class="btn btn-warning">Browse Products</a>
                    </div>  
                @else

                <div class="row justify-content-between">
                    @php
                    $subTotal = $grandTotal = $couponCodeDiscount = 0;
                    @endphp
                    @php $sum = 0; @endphp
                    
                        <div class="col-md-6 mb-3 dash-card-col">
                            @foreach ($orderProducts as $key => $orderProduct)

                    @php $sum = $sum + $orderProduct->amount; @endphp
                            <div class="card card-body mb-2 border-0 shadow-sm">
                                {{-- {{($loop->first ? '' : ', ').($order->order_no ? $order->order_no: '') . ' ' .($order->productDetails->name ? $order->productDetails->name: '')}} --}}
                                {{-- @php if ($key == 2) {echo '...';break;} @endphp --}}
           
                                <h4 class="mb-2">Order Id: {{$orderProduct->order_no ? $orderProduct->order_no: ''}}</h4>
                                <h6 class="mb-2">Product Name : {{$orderProduct->productDetails ? $orderProduct->productDetails->name: ''}}</h6>
                                <h6 class="mb-2">Price: ₹{{ $orderProduct->amount}}/-</h6>
                                {{-- @if($orderProduct->status = 1)
                                <h6 class="mb-2">Order Status: New</h6>
                                @elseif($orderProduct->status = 2)
                                <h6 class="mb-2">Order Status: Confirm</h6>
                                @elseif($orderProduct->status = 3)
                                <h6 class="mb-2">Order Status: Shipped</h6>
                                @elseif($orderProduct->status = 4)
                                <h6 class="mb-2">Order Status: Deliveredr</h6>
                                @elseif($orderProduct->status = 5)
                                <h6 class="mb-2">Order Status: Cancel</h6>
                                @endif --}}
                                {{-- $orders --}}
                                {{-- @foreach ($order->orderProduct as $orderProduct)
                                       
                                @endforeach --}}
                                {{-- <h5 class="mb-2">{{$order->productDetails->name ? $order->productDetails->name: ''}}</h5> --}}
                                {{-- <p class="small mb-0"> --}}
                               
                                </p>
                                {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                            </div>
                        @endforeach
                        </div>    
                    
                    @php
                    $subTotal = (int) $sum;
                   

                    // $grandTotalWithoutCoupon = $orders->amount;
                    $discount = ($subTotal ) - $orders->amount;
                    $percentage = 18;
                    $totalWidth = $orders->amount;
                    $new_width = ($percentage / 100) * $totalWidth;
                    $total = $totalWidth + $new_width;

                    @endphp

                    <div class="col-md-5 mb-3 dash-card-col">
                        <div class="card card-body mb-0 shadow border-0">
                            <table class="table">
                                <tr>
                                    <td class="border-top-0">Subtotal</td>
                                    <td class="border-top-0"><b>₹ {{$sum}}/-</b></td>
                                </tr>
                                 <tr>
                                    <td>Discounted Amount</td>
                                    <td><b>₹ {{$discount}}/-</b></td>
                                </tr>
                                 <tr>
                                    <td>Grand Total</td>
                                    <td><b>₹ {{$orders->amount}}/-</b></td>
                                </tr>
                                 {{-- <tr>
                                    <td>GST Charge(18%)</td>
                                    <td><b>₹ {{$new_width}}/-</b></td>
                                </tr> --}}
                                 <tr>
                                    <th>Total</th>
                                    <td><b>₹ {{$orders->amount}}/-</b></td>
                                </tr>
                            </table>
                            <!--<h5> Subtotal </h5><p class="mb-2">₹.{{$sum}}/-</p>
                            <h5> Discounted Amount </h5><p class="mb-2">₹.{{$discount}}/-</p>

                            <h5> Grand Total </h5><p class="mb-2">₹.{{$orders->amount}}/-</p>
                            <h5> GST Charge(18%) </h5><p class="mb-2">₹.{{$new_width}}/-</p>
                            <h5>  Total </h5><p class="mb-2">₹.{{$total}}/-</p-->

                            </p>
                        </div>
                    </div>    
                   

                </div>
                @endif

            </div>
            
            {{-- @endif --}}
        </div>
    </div>
</section>
@endsection