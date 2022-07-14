@extends('frontend.layouts.master')
@section('content')
    <section class="banner-area cart-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        {{-- <h2 data-aos="fade-down" data-aos-duration="1000">Cart</h2> --}}
                        <div class="shadow_text">Filingrabbit</div>
                    </div>
                    {{-- <a href="{{ url('/')}}" class="home">Home</a> / <span>Cart</span> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Cart Details Section ==================== -->
    <section class="py-4 py-lg-5">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-6">
                <div class="cart-details-table">
                    <table class="table mb-1">
                        <tr>
                            <th>
                                <a href="#">
                                    <i class="fa fa-times"></i>
                                </a>
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Product:</td>
                            <td>Lorem ipsum dolor</td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td>Rs. 7,000/-</td>
                        </tr>
                        <tr>
                            <td>Quantity:</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Subtotal:</td>
                            <td>Rs. 7,000/-</td>
                        </tr>
                    </table>
                    <form action="">
                        <div class="form-group mb-0 d-flex align-items-center">
                            <input type="text" class="form-control" placeholder="Coupon Code">
                            <button type="submit" class="btn ur-submit-button ml-3 w-auto"> Apply </button>
                        </div>
                    </form>
                </div>
            </div> --}}
                <div class="col-md-12">
                    <div class="cart-details-table">

                        <script>
                            setTimeout(() => {
                                window.location.href = "{{ route('frontend.cart.show') }}";
                            }, 15000);
                        </script>
                        <h5>Payment Failure</h5>
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaction details</h4>
                            </div>
                            <div class="card-body">
                                <p>Bank Ref No.: <small>{{ $data['bank_ref_num'] }}</small></p>
                                <p>Payment Source: <small>{{ $data['payment_source'] }}</small></p>
                                <p>Product Info: <small>{{ $data['productinfo'] }}</small></p>
                                <p>Transaction Id: <small>{{ $data['txnid'] }}</small></p>
                                <p>Amount: <small>{{ $data['amount'] }}</small></p>
                                <p>Status: <small>{{ $data['status'] }}</small></p>
                            </div>
                        </div>
                        {{-- @php
                            echo '<pre>';
                            print_r($data);
                        @endphp --}}

                        <a href="{{ route('frontend.cart.show') }}">Go to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
