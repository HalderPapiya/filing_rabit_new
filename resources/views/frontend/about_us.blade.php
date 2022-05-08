@extends('frontend.layouts.master')
@section('content')


    <!-- ==================== Banner Section ==================== -->
    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2 data-aos="fade-down" data-aos-duration="1000">About Us</h2>
                        <div class="shadow_text">Filingrabbit</div>
                    </div>
                    <a href="{{ route('home')}}" class="home">Home</a> / <span>About Us</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== About Block Section ==================== -->
    <section class="about__block">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="about__large_image">
                        {{-- <img class="img-fluid" src="https://filingrabbit.in/wp-content/uploads/2021/06/excellence-operationnelle-service-forces-vente-F-1.jpg"> --}}
                        <img class="img-fluid" src="{{URL::to('/').'/uploads/about_us/'}}{{$aboutUs->image2}}">
                        <div class="about_small_image">
                            {{-- <img src="https://filingrabbit.in/wp-content/uploads/2021/06/e44a9ae9b09ffeb97db41ea20b02f6af.png"> --}}
                            <img src="{{URL::to('/').'/uploads/about_us/'}}{{$aboutUs->image1}}">

                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="w-100 heading text-left">
                        <h1>About Filing rabbit</h1>
                        <div class="shadow_text">Know Us</div>
                    </div>
                    <div>
                        <p>
                           {!!$aboutUs->description!!}
                        </p>
                        {{-- <p>
                            We understand every start-up is a bridge between dreams and reality. We understand how important your start-up is to you, after all, we are one too! We all know it too well that in this fish-eats-fish world, very few start-ups survive. This happens not because of the lack of effort but due to improper preparation and guidance. This is where we come into the picture. We will help your stat-up shine bright like it is supposed to be while getting it an identity it deserves.
                        </p>
                        <p>
                            Filing rabbit is a one-stop solution shaping your start-up into a concrete form to cope with the ever-growing, ever-competing world that we live in. Our goal is to remove hurdles from your path to help you build your organization the way you imagined. Be it legal, technical, or identity assistance, we have got you covered. With our 24X7 assistance, your startup will potentially have a world full of opportunities to explore.
                        </p>
                        <p>
                            Our team understands that starting up something new can be a little overwhelming and stressful, but hey! One leap of faith is all it takes. Once you take that leap, let us take care of all your secondary worries so you can put focus on your primary motive- GROWTH.
                        </p>
                        <p>
                            Filing rabbit- leading you towards the success you deserve.
                        </p> --}}
                    </div>
                </div>
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
                    <a class="btn btn-theme-outline" href="{{ route('frontend.blog')}}">All Our Blogs</a>
                </div>

                <div class="col-sm-7">
                    <div class="row">
                        @foreach ($blogs as $blog)
                        <div class="col-sm-6">
                            <div class="blog_image">
                                <img src="{{URL::to('/').'/uploads/blog/'}}{{$blog->image}}">
                            </div>
                            <div class="blog_content">
                                <h3>
                                    <a href="{{ route('frontend.blog.show', $blog['id']) }}">
                                        {{$blog->title}}
                                    </a>
                                </h3>
                                <p>
                                {!! substr($blog->description, 0, 200); !!}
                                </p>
                                <a href="{{ route('frontend.blog.show', $blog['id']) }}" class="readmore_btn"><span>Read More</span></a>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="col-sm-6">
                            <div class="blog_image">
                                <img src="img/The-procedure-of-getting-copyright-with-all-the-legal-formalities.jpg"
                                    alt="Image not found">
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
