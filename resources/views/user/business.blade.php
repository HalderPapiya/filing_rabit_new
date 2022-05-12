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
                <div class="my-account-form-wrapper">
                    <h3>Billing address</h3>
                    <form action="{{route('user.businessService.store')}}" method="POST">
                        @csrf
                        {{-- <input type="hidden" value="{{$address->id}}" name="id" class="form-control"> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label> Valuation</label>
                                    <input type="text" name="valuation" class="form-control">
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <button type="submit" class="btn ur-submit-button w-auto">Save Address</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-3">
                        <nav class="sticky-top my-account-navigation">
                            <ul>
                                @foreach ($businessServices as $businessService)
                                <li>
                                    <a href="dashboard.html">{{$businessService->name}}</a>
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