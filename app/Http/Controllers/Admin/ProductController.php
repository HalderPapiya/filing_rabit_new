<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Contracts\SubCategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * @var ProductContract
     */
    protected $productRepository;

    /**
     * ProductController constructor.
     * 
     * @param ProductContract $productRepository
     */
    public function __construct(ProductContract $productRepository, SubCategoryContract $subCategoryRepository, CategoryContract $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->productRepository->listProducts();
        $this->setPageTitle('Product', 'List of all product');
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories();
        $subCategories = $this->subCategoryRepository->listSubCategories();
        $this->setPageTitle('Product', 'Create Product');
        return view('admin.product.create', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' =>  'required',
        //     'price' =>  'required',
        // ]);

        $params = $request->except('_token');

        $data = $this->productRepository->createProduct($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.product.index', 'Product has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->listCategories();
        $subCategories = $this->subCategoryRepository->listSubCategories();
        $data = $this->productRepository->findProductById($id);

        $this->setPageTitle('Product', 'Edit product : ' . $data->title);
        return view('admin.product.edit', compact('data', 'categories', 'subCategories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'name' =>  'required',
        //     'price' =>  'required',
        // ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->productRepository->updateProduct($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.product.index', 'Product updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->productRepository->deleteProduct($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.product.index', 'Product deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->productRepository->updateProductStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Product status successfully updated'));
        }
    }
}