@php
$categories = App\Models\Category::get();
$categories = App\Models\Category::get();
$products = App\Models\Category::get();
$contactUs = App\Models\ContactUs::orderBy('id', 'desc')->first();

@endphp
  <!-- ==================== Top Header ==================== -->
    <section class="top_header">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <ul class="header_contact">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-mail">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <a href="mainto:info@filingrabbit.in">{{$contactUs->email}}</a>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            <a href="tel:9674759336">{{$contactUs->sales_phone}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-7 text-center text-sm-right">
                    <ul id="menu-topmenu" class="top-menu">
                        <li><a href="{{ route('frontend.about-us')}}" class="nav-link">About Us</a></li>
                        <li><a href="{{ route('frontend.blog')}}" class="nav-link">Blog</a></li>
                        <li><a href="{{ route('frontend.contact-us')}}" class="nav-link">Contact Us</a></li>
                        <li class="login_btn"><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== Navigation Header ==================== -->
    <section class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand logo" href="{{ route('home')}}">
                    <img class="img-fluid" src="{{asset('frontend/img/logo.png')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @foreach ($categories as $category)
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                {{$category->title}}
                                {{-- Protecting your business --}}
                                <i class="fa fa-chevron-down"></i>
                            </a>
                            <div class="sub-menu">
                                <div class="row m-0 h-100">
                                    @foreach ($category->subCategory as $subcat)
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <a href="{{ route('frontend.product.list', $subcat['id']) }}" class="nav-link"><h4>{{$subcat->title}}</h4></a>
                                        <ul>
                                            @foreach ($subcat->product as $product)
                                            <li><a href="{{ route('frontend.product.show', $product['id']) }}">{{$product->name}}</a></li>

                                            @endforeach
                                            {{-- product --}}
                                            {{-- <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li> --}}
                                        </ul>
                                    </div>
                                    @endforeach
                                    {{-- <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Trademark</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Copyright</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Patent</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Industrial Design</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </li>
                        @endforeach

                        {{-- <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                Protecting your business
                                <i class="fa fa-chevron-down"></i>
                            </a>
                            <div class="sub-menu">
                                <div class="row m-0 h-100">
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Trademark</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Copyright</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Patent</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Industrial Design</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                Legal Draft
                                <i class="fa fa-chevron-down"></i>
                            </a>
                            <div class="sub-menu">
                                <div class="row m-0 h-100">
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Trademark</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Copyright</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Patent</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-4 mb-sm-0">
                                        <h4>Industrial Design</h4>
                                        <ul>
                                            <li><a href="#">Lorem ipsum</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </nav>
        </div>
    </section>
