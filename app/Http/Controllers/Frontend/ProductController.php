<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Contracts\BlogContract;
use App\Contracts\ProductContract;
use App\Contracts\SettingContract;
use App\Http\Controllers\BaseController;
use App\Models\Description;
use Illuminate\Http\Request;

class ProductController extends BaseController
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
        ProductContract $productRepository,
        SettingContract $settingRepository
    ) {
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
        $this->productRepository = $productRepository;
        $this->settingRepository = $settingRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = $this->categoryRepository->listCategories();
        $subCategories = $this->subCategoryRepository->listSubCategories();
        $products = $this->productRepository->listProducts();



        return view('frontend.index', compact('subCategories', 'categories',  'products'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showProduct($id)
    {
        $product = $this->productRepository->findProductById($id);
        $productDes = Description::where('product_id', $product->id)->get();
        $faqs = $this->settingRepository->listFaqs();
        return view('frontend.product_details', compact('product', 'productDes', 'faqs'));
    }
    public function product($id)
    {
        // dd($id);
        // $product = $this->productRepository->findProductById($id);
        $product = $this->productRepository->listProductsSubCatWise($id);
        // dd($product);


        return view('frontend.product', compact('product'));
    }
    public function productDescription()
    {


        return view('frontend.product_details', compact('product'));
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