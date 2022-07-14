@extends('frontend.layouts.master')
@section('content')
    <!-- ==================== Banner Section ==================== -->
    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2 data-aos="fade-down" data-aos-duration="1000">NEWSLETTER</h2>
                        <div class="shadow_text">Filingrabbit</div>
                    </div>
                    <a href="{{route('home')}}" class="home">Home</a> / <span>Newsletter</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Content Section ==================== -->
    <section class="py-4 py-lg-5 product__content">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <p>
                        Your subscription has been confirmed 
                    </p>

                   
                </div>
            </div>
        </div>
    </section>
@endsection

