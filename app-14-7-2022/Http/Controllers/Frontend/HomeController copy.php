<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Contracts\BlogContract;
use App\Http\Controllers\BaseController;
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
    public function __construct(SubCategoryContract $subCategoryRepository, CategoryContract $categoryRepository,  BlogContract $blogRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->lisCategories();
        $subCategories = $this->subCategoryRepository->listSubCategories();
        $blogs = $this->blogRepository->listBlogs();


        return view('frontend.blog', compact('subCategories', 'categories', 'blogs'));
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