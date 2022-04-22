@extends('frontend.layouts.master')
@section('content')
    
    <!-- ==================== Blogs Body ==================== -->
    <section class="blog-body">
        <div class="container">
            <div class="row">
            @foreach($blogs as $blog)
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="{{URL::to('/').'/uploads/blog/'}}{{$blog->image}}" />
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                {{$blog->title}}
                            </a>
                        </h3>
                        <p> {!! substr($blog->description, 0, 200); !!}</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
            @endforeach
                {{-- <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 mb-4 mb-md-5">
                    <div class="blog_image">
                        <img src="img/The-legal-procedure-of-Trademark-Registration-and-hearing-in-India.jpg">
                    </div>
                    <div class="blog_content">
                        <h3>
                            <a href="#">
                                The legal procedure of Trademark Registration and hearing in India!
                            </a>
                        </h3>
                        <p>Trademark is one among the kinds of property within the area of product and...</p>
                        <a href="#" class="readmore_btn"><span>Read More</span></a>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection