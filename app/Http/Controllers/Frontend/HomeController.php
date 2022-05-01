<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\AboutUsContract;
use App\Http\Controllers\Controller;
use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Contracts\BlogContract;
use App\Contracts\BannerContract;
use App\Contracts\ContactUsContract;
use App\Contracts\IndustriesServeContract;
use App\Contracts\ProductContract;
use App\Contracts\SettingContract;
use App\Contracts\TestimonialContract;
use App\Contracts\WhyUsContract;
use App\Contracts\DescriptionContract;
use App\Http\Controllers\BaseController;
use App\Models\IndustriesServe;
use Illuminate\Http\Request;

class HomeController extends BaseController
{

    /**
     * HomeController constructor.
     *
     * @param SubCategoryContract $subCategoryRepository
     * @param CategoryContract $categoryRepository
     * @param BlogContract $blogRepository
     */
    public function __construct(
        SubCategoryContract $subCategoryRepository,
        CategoryContract $categoryRepository,
        BlogContract $blogRepository,
        AboutUsContract $aboutUsRepository,
        ProductContract $productRepository,
        WhyUsContract $whyUsRepository,
        IndustriesServeContract $industriesServeRepository,
        TestimonialContract $testimonialRepository,
        ContactUsContract $contactUsRepository,
        BannerContract $bannerRepository,
        SettingContract $settingRepository,
        DescriptionContract $descriptionRepository
    ) {
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
        $this->aboutUsRepository = $aboutUsRepository;
        $this->productRepository = $productRepository;
        $this->whyUsRepository = $whyUsRepository;
        $this->industriesServeRepository = $industriesServeRepository;
        $this->testimonialRepository = $testimonialRepository;
        $this->contactUsRepository = $contactUsRepository;
        $this->bannerRepository = $bannerRepository;
        $this->settingRepository = $settingRepository;
        $this->descriptionRepository = $descriptionRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutUs = $this->aboutUsRepository->latestAboutUs();
        $banner = $this->bannerRepository->latestBanner();
        // $contactUs = $this->contactUsRepository->latestContactUs();
        // dd($banner);
        $categories = $this->categoryRepository->listCategories();
        $subCategories = $this->subCategoryRepository->listSubCategories();
        $blogs = $this->blogRepository->listBlogs();
        $products = $this->productRepository->listProducts();
        $whyUs = $this->whyUsRepository->listWhyUs();
        $IndustriesServes = $this->industriesServeRepository->listIndustriesServes();
        $testimonials = $this->testimonialRepository->listTestimonials();
        $blogs = $this->blogRepository->listBlogs();


        return view('frontend.index', compact('subCategories', 'categories', 'blogs', 'aboutUs', 'products', 'whyUs', 'IndustriesServes', 'testimonials', 'blogs','banner'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $blogs = $this->blogRepository->listBlogs();


        return view('frontend.blog', compact('blogs'));
    }
    public function contactUs()
    {
        $contact = $this->contactUsRepository->latestContactUs();


        return view('frontend.contact', compact('contact'));
    }

    public function aboutUs()
    {
        // $blogs = $this->blogRepository->listBlogs();
        $blogs = $this->blogRepository->latestBlog();
        $data = $this->aboutUsRepository->listAboutUs();
        $aboutUs = $this->aboutUsRepository->latestAboutUs();

        return view('frontend.about_us', compact('data','aboutUs','blogs'));
    }
    public function showBlog($id)
    {
        $blog = $this->blogRepository->findBlogById($id);

        // $this->setPageTitle('Blog', 'Edit Category : ' . $blog->title);
        return view('frontend.blog_details', compact('blog'));
    }
    public function showProduct($id)
    {
        $product = $this->productRepository->findProductById($id);
        $productDes = $this->productRepository->listProductsDescription($product);
        
        // $productDes = $this->descriptionRepository->productWiseDescriptions($id);
        // dd($productDes);
        // $this->setPageTitle('Blog', 'Edit Category : ' . $blog->title);
        return view('frontend.product_details', compact('product','productDes'));
    }
    public function product()
    {
        $product = $this->productRepository->listProducts();


        return view('frontend.product_details', compact('product'));
    }
    public function productDescription()
    {
       

        return view('frontend.product_details', compact('product'));
    }
    // productWiseDescriptions
    public function privacyPolicy()
    {
        $privacy = $this->settingRepository->privacyPolicy();

// dd($privacy);
        return view('frontend.privacy_policy', compact('privacy'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
