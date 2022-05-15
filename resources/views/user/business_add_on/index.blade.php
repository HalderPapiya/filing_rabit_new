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
            <div class="col-md-9">
                <div class="col-md-9">
                    

                <div class="fixed-row">
                    <div class="app-title">
                        <a href="{{ route('user.business_add_on.create') }}" class="btn btn-primary pull-right"><i class="fa fa-fw fa-lg fa-plus"></i>Add New</a>
                    </div>
                </div>
                <div class="my-account-form-wrapper">
                    <h3>Business Service</h3>
                   
                    <div class="col-md-3">
                        <nav class="sticky-top my-account-navigation">
                            <ul>
                                @foreach ($businessAddOns as $data)
                                <li>
                                    <a href="{{ route('user.business_add_on.edit', $data['id']) }}">{{$data->name}}</a>
                                </li>
                                @endforeach
                                
                                
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
        
        </div>
    </div>
</section>

@endsection