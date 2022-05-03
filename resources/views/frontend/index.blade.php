@extends('frontend.layouts.master')
@section('content')
    <!-- ==================== Banner Section ==================== -->
    <section class="page_banner">
        <!-- <div class="home_banner">
            <div class="banner_ratio">
                <video width="320" height="240" loop="" autoplay="autoplay" muted="">
                    <source src="https://filingrabbit.in/wp-content/uploads/2021/10/Project-Name.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="banner_caption">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="section_title">
                            <h1>Filing Rabbit</h1>
                        </div>
                        <h4>We do the hustle, so you don't have to hassle.</h4>
                        <a class="btn btn-theme-outline" href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="home_banner">
            <div class="banner_ratio">
                <video width="320" height="240" loop="" autoplay="autoplay" muted="">
                    <source src="{{URL::to('/').'/uploads/banners/'}}{{$banner->video}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="banner_caption">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="section_title">
                            <h1>{{$banner->title}}</h1>
                        </div>
                        <h4>{!! $banner->short_description !!}</h4>
                        <a class="btn btn-theme-outline" href="{{ route('frontend.about-us')}}">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== About Section ==================== -->
    <section class="about_section" id="about">
        <div class="container">
            <div class="row pt-0 pt-md-0 justify-content-between align-items-center">
                <div class="col-sm-9 layer-9">
                    <div class="section_title mb-4" data-aos="fade-up" data-aos-duration="1000">
                        <h1>About Us</h1>
                    </div>
                    <p>
                        {{-- We understand every start up is a bridge between dreams and reality. We understand how important
                        your start-up is to you, after all, we are one too! We all know it too well that in this
                        fish-eats-fish world, very few start-ups survive. This happens not because of the lack in
                        efforts but due to improper preparation and guidance. This is where we come into the picture. We
                        will help your stat -up shine bright like it is supposed to be while getting it an identity it
                        deserves. --}}
                        {!! $aboutUs->description !!}
                    </p>

                </div>

                <div class="col-sm-3">
                    <a href="{{ route('frontend.about-us')}}" class="btn btn-dark-outline">Read more</a>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== Products Section ==================== -->
    <section class="product_Section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 text-center">
                    <h2>Welcome to Filing Rabbit</h2>
                </div>
                <div class="col-12">
                    <div class="product_slider">
                        @foreach ($products as $product)
                        <div class="product_block">
                            <figure>
                                <a href="{{ route('frontend.product')}}">
                                    <img class="img-fluid" src="{{URL::to('/').'/uploads/product/'}}{{$product->image}}">
                                </a>
                            </figure>
                            <figcaption>
                                <h3>
                                    <a href="{{ route('frontend.product.show',$product->id)}}">{{$product->name}}</a>
                                </h3>
                                <a href="{{ route('frontend.product.show',$product->id)}}" class="btn btn-theme-outline">
                                    <span class="price">{{$product->type_one_price}}</span>
                                </a>
                            </figcaption>
                        </div>
                        @endforeach

                        {{-- <div class="product_block">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="https://filingrabbit.in/wp-content/uploads/2021/03/product.jpg">
                                </a>
                            </figure>
                            <figcaption>
                                <h3>
                                    <a href="#">Non-Disclosure Agreement for Third Party/Employee</a>
                                </h3>
                                <a href="#" class="btn btn-theme-outline">
                                    <span class="price">₹11,000.00</span>
                                </a>
                            </figcaption>
                        </div>
                        <div class="product_block">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="https://filingrabbit.in/wp-content/uploads/2021/03/product.jpg">
                                </a>
                            </figure>
                            <figcaption>
                                <h3>
                                    <a href="#">Non-Disclosure Agreement for Third Party/Employee</a>
                                </h3>
                                <a href="#" class="btn btn-theme-outline">
                                    <span class="price">₹11,000.00</span>
                                </a>
                            </figcaption>
                        </div>
                        <div class="product_block">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="https://filingrabbit.in/wp-content/uploads/2021/03/product.jpg">
                                </a>
                            </figure>
                            <figcaption>
                                <h3>
                                    <a href="#">Non-Disclosure Agreement for Third Party/Employee</a>
                                </h3>
                                <a href="#" class="btn btn-theme-outline">
                                    <span class="price">₹11,000.00</span>
                                </a>
                            </figcaption>
                        </div>
                        <div class="product_block">
                            <figure>
                                <a href="#">
                                    <img class="img-fluid" src="https://filingrabbit.in/wp-content/uploads/2021/03/product.jpg">
                                </a>
                            </figure>
                            <figcaption>
                                <h3>
                                    <a href="#">Non-Disclosure Agreement for Third Party/Employee</a>
                                </h3>
                                <a href="#" class="btn btn-theme-outline">
                                    <span class="price">₹11,000.00</span>
                                </a>
                            </figcaption>
                        </div> --}}
                    </div>
                    <div class="product_arrow mt-4">
                        <ul class="d-flex justify-content-center align-items-center">
                            <li class="prev">
                                <i class="fa fa-arrow-left"></i>
                            </li>
                            <li class="next">
                                <i class="fa fa-arrow-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Why Choose Us Section ==================== -->
    <section class="why_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title text-center">
                        <h2 data-aos="fade-down" data-aos-duration="1000">Why Us?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="why_us_list">
                        @foreach ($whyUs as $key => $whyUs)
                        <li>
                            <span>{{$key + 1}}</span>
                            <img src="{{URL::to('/').'/uploads/why_us/'}}{{$whyUs->image}}">
                            <h5>{{$whyUs->title}}:</h5>
                            <p>
                                {{-- Our company has been in the cloud based intellectual property service platform since the
                                last 6 years. --}}
                                {!!$whyUs->description!!}

                            </p>
                        </li>
                        @endforeach
                        {{-- <li>
                            <span>1</span>
                            <img src="{{asset('frontend/img/power-plant.png')}}">
                            <h5>Been in the industry:</h5>
                            <p>
                                Our company has been in the cloud based intellectual property service platform since the
                                last 6 years.
                            </p>
                        </li>
                        <li>
                            <span>2</span>
                            <img src="{{asset('frontend/img/pricing.png')}}">
                            <h5>Reasonable prices:</h5>
                            <p>
                                We guarantee a high level of services for reasonable prices.
                            </p>
                        </li>
                        <li>
                            <span>3</span>
                            <img src="{{asset('frontend/img/radar.png')}}">
                            <h5>Range:</h5>
                            <p>
                                Our company offers a wide range of IP services- patent, trademark, design and copyright.

                            </p>
                        </li>
                        <li>
                            <span>4</span>
                            <img src="{{asset('frontend/img/practice.png')}}">
                            <h5>Field of expertise:</h5>
                            <p>
                                It covers every area of the technical field including physics, mechanics, electronics,
                                microelectronics and chemistry.
                            </p>
                        </li>
                        <li>
                            <span>5</span>
                            <img src="{{asset('frontend/img/padlock.png')}}">
                            <h5>Versatile:</h5>
                            <p>
                                We are a versatile patent and trademark platform with widespread activities in protection
                                of intellectual property.
                            </p>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Process Section ==================== -->
    <section class="process_section">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="section_title text-center mt-0">
                        <h2 data-aos="fade-down" data-aos-duration="1000">Our Process</h2>
                    </div>
                </div>
                @foreach ($processes as $processes)
                <div class="col-sm-2 p_step">
                    <div class="process_wrap bg-danger">
                        <div class="process_block">
                            <h5>{{$processes->title}}</h5>
                        </div>
                        <div class="process_rblock">
                            <p>{{$processes->description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-sm-2 p_step">
                    <div class="process_wrap bg-danger">
                        <div class="process_block">
                            <h5>1.Understanding Requirements</h5>
                        </div>
                        <div class="process_rblock">
                            <p>We collect and understand the requirments from clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 p_step">
                    <div class="process_wrap bottom bg-secondary">
                        <div class="process_block">
                            <h5>2.Analysis of Requirments</h5>
                        </div>
                        <div class="process_rblock">
                            <p>Analyzing the requirments of client as per the new ideas and technologies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 p_step">
                    <div class="process_wrap bg-warning">
                        <div class="process_block">
                            <h5>3.Portfolio</h5>
                        </div>
                        <div class="process_rblock">
                            <p>Creating a portfolio of project process for understanding of clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 p_step">
                    <div class="process_wrap bottom bg-success">
                        <div class="process_block">
                            <h5>4.Working</h5>
                        </div>
                        <div class="process_rblock">
                            <p>Getting done all the work of project inconsideration of client.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 p_step">
                    <div class="process_wrap bg-info">
                        <div class="process_block">
                            <h5>5.Delivery / Feedback</h5>
                        </div>
                        <div class="process_rblock">
                            <p>Deployment of legal assets and website to client and get the feedback from client.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 p_step">
                    <div class="process_wrap bottom bg-primary">
                        <div class="process_block">
                            <h5>6.Maintenance</h5>
                        </div>
                        <div class="process_rblock">
                            <p>Maintenance of work which is deployed to client.</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- ==================== Industries Section ==================== -->
    <section class="industry_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title text-center mt-0">
                        <h2 data-aos="fade-down" data-aos-duration="1000">Industries Served</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="served_slider">
                        @foreach ($IndustriesServes as $IndustriesServes)
                        <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{URL::to('/').'/uploads/industries_serve/'}}{{$IndustriesServes->image}}">
                                </div>
                                <div>
                                    <h5 class="h6">{{$IndustriesServes->title}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{asset('frontend/img/automobile.png')}}">
                                </div>
                                <div>
                                    <h5 class="h6">AUTOMOBILE</h5>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{asset('frontend/img/it.png')}}">
                                </div>
                                <div>
                                    <h5 class="h6">IT & ITES</h5>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{asset('frontend/img/media.png')}}">
                                </div>
                                <div>
                                    <h5 class="h6">MEDIA & ENTERTAINMENT</h5>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{asset('frontend/img/ecom.png')}}">
                                </div>
                                <div>
                                    <h5 class="h6">E-COMMERCE</h5>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{asset('frontend/img/ecom.png')}}">
                                </div>
                                <div>
                                    <h5 class="h6">FMCG</h5>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-custom text-center served-bg">
                            <div class="card-body p-0">
                                <div class="icon">
                                    <img src="{{asset('frontend/img/consume.png')}}">
                                </div>
                                <div>
                                    <h5 class="h6">CONSUMER DURABLES</h5>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="industry_arrow mt-4">
                        <ul class="d-flex justify-content-center align-items-center">
                            <li class="prev">
                                <i class="fa fa-arrow-left"></i>
                            </li>
                            <li class="next">
                                <i class="fa fa-arrow-right"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Free Consultation Section ==================== -->
    <section class="poster_section">
        <div class="container text-center">
            <h2>Ready to get started? It's fast, free and very easy!</h2>
            <a href="#" data-toggle="modal" data-target="#consultation_modal" class="btn btn-dark-outline">
                Book a free Consultation
            </a>
        </div>
    </section>

    <!-- ==================== Vocal For Local Poster ==================== -->
    <section class="pt-5">
        <div class="container">
            <img class="img-fluid" src="{{asset('frontend/img/center-banner.png')}}">
        </div>
    </section>

    <!-- ==================== Vocal For Local Section ==================== -->
    <section class="vocal_bg">
        <div class="container">
            <div class="row align-items-center">
                @foreach ($testimonials as $testimonial)
                <div class="col-lg-4 col-md-4 col-sm-4 mb-4 mb-md-4 mb-lg-0 h-355" data-aos="fade-right"
                data-aos-duration="3000">
                    <div class="rounded-custom">
                        <div class="card-body p-0">
                            <div>
                                <h5 class="h6">
                                    {{-- We support the Startup India initiative that aims to accelerate entrepreneurship in
                                    the country and create startups. --}}
                                    {{$testimonial->description}}
                                </h5>
                            </div>
                            <div class="icon icon-md text-secondary pt-4">
                                <img src="{{URL::to('/').'/uploads/testimonial/'}}{{$testimonial->image}}">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- <div class="col-lg-4 col-md-4 col-sm-4 mb-4 mb-md-4 mb-lg-0 h-355" data-aos="fade-up"
                    data-aos-duration="1500">
                    <div class="rounded-custom">
                        <div class="card-body p-0">
                            <div>
                                <h5 class="h6">
                                    We support the Digital India initiative for digitizing Government activities and
                                    helping improve digital literary.
                                </h5>
                            </div>
                            <div class="icon icon-md text-secondary pt-4">
                                <img src="{{asset('frontend/img/Digital_India_logo.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 mb-4 mb-md-4 mb-lg-0 h-355" data-aos="fade-left"
                    data-aos-duration="3000">
                    <div class="rounded-custom">
                        <div class="card-body p-0">
                            <div>
                                <h5 class="h6">
                                    We support the Make in India initiative that encourages and facilitates foreign
                                    investment into the country.
                                </h5>
                            </div>
                            <div class="icon icon-md text-secondary pt-4">
                                <img src="{{asset('frontend/img/Make_In_India.png')}}">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- ==================== Blogs Section ==================== -->
    <section class="blog_section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-5">
                    <div class="section_title mt-0">
                        <h2 data-aos="fade-down" data-aos-duration="1000">Our Blogs</h2>
                        <div class="shadow_text">Know</div>
                    </div>
                    <h4>The less boring side of your development.</h4>
                    <a class="btn btn-theme-outline" href="#">All Our Blogs</a>
                </div>

                <div class="col-sm-7">
                    <div class="row">
                        @foreach ($blogs as $blog)
                        <div class="col-sm-6">
                            <div class="blog_image">
                                <img src="{{URL::to('/').'/uploads/blog/'}}{{$blog->image}}" alt="Image not found" >
                            </div>
                            <div class="blog_content">
                                <h3>
                                    <a href="#">
                                        {{$blog->title}}
                                        {{-- All You Need To Know About the Power Of Attorney Services --}}
                                    </a>
                                </h3>
                                <p>
                                    {!!$blog->description!!}
                                    {{-- A power of attorney (POA) is a legal authorization that offers a post to... --}}
                                </p>
                                <a href="{{ route('frontend.blog')}}" class="readmore_btn"><span>Read More</span></a>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="col-sm-6">
                            <div class="blog_image">
                                <img src="{{asset('frontend/img/The-procedure-of-getting-copyright-with-all-the-legal-formalities.jpg')}}" alt="Image not found" >
                            </div>
                            <div class="blog_content">
                                <h3>
                                    <a href="#">
                                        What are the Prime Features of a Non-Disclosure Agreement for Third Party?
                                    </a>
                                </h3>
                                <p>
                                    A non-discloser agreement or NDA is a legal contract that forms a trusted
                                    relationship...
                                </p>
                                <a href="#" class="readmore_btn"><span>Read More</span></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
