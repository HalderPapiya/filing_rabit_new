@extends('frontend.layouts.master')
@section('content')
    <!-- ==================== Banner Section ==================== -->
    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2 data-aos="fade-down" data-aos-duration="1000">Trademark</h2>
                        <div class="shadow_text">Filingrabbit</div>
                    </div>
                    <a href="{{ route('home')}}" class="home">Home</a> / <a href="#" class="home">Products</a> / <span>Trademark</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Products Section ==================== -->
    <section class="product_section pt-5 pb-5">
        <div class="container">
            <div class="row">
               {{-- @php echo $product; exit;
               @endphp --}}
                @foreach ($product->product as $data)
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="{{URL::to('/').'/uploads/product/'}}{{$data->image}}">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">{{$data->name}}</a>
                            </h3>
                            <strong class="price">From: ₹{{$data->type_one_price}}</strong>
                        </figcaption>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="product_block">
                        <figure>
                            <a href="#">
                                <img class="img-fluid" src="img/product.jpg">
                            </a>
                        </figure>
                        <figcaption>
                            <h3>
                                <a href="#">TradeMark Registration</a>
                            </h3>
                            <strong class="price">From: ₹6,000.00</strong>
                        </figcaption>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

 @endsection