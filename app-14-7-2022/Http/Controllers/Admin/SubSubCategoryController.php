<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SubSubCategoryContract;
use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SubSubCategoryController extends BaseController
{
    /**
     * @var SubSubCategoryContract
     */
    // protected $categoryRepository;
    // protected $subSubCategoryRepository;

    /**
     * SubCategoryController constructor.
     * 
     * @param SubSubCategoryContract $subSubCategoryRepository
     */
    public function __construct(
        SubSubCategoryContract $subSubCategoryRepository,
        CategoryContract $categoryRepository,
        SubCategoryContract $subCategoryRepository
    ) {
        $this->subSubCategoryRepository = $subSubCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->subSubCategoryRepository->listSubSubCategories();


        $this->setPageTitle('Sub-Subcategory', 'List of all sub-subcategories');
        return view('admin.sub_subcategory.index', compact('data'));
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
        $this->setPageTitle('Sub-Subcategory', 'Create Sub-Subcategory');
        return view('admin.sub_subcategory.create', compact('categories', 'subCategories'));
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
        //     'title' =>  'required',
        //     'categoryId' =>  'required',
        // ]);

        $params = $request->except('_token');

        $data = $this->subSubCategoryRepository->createSubSubCategory($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating sub-subcategory.', 'error', true, true);
        }
        return $this->responseRedirect('admin.sub-subcategory.index', 'Sub-Subcategory has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->listCategories();
        $subCategories = $this->categoryRepository->listCategories();
        $data = $this->subSubCategoryRepository->findSubSubCategoryById($id);

        $this->setPageTitle('Sub-Subcategory', 'Edit Sub-Subcategory : ' . $data->title);
        return view('admin.sub_subcategory.edit', compact('data', 'subCategories', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            // 'category_id' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->subSubCategoryRepository->updateSubSubCategory($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating sub-subcategory.', 'error', true, true);
        }
        return $this->responseRedirectBack('sub-subcategory updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->subSubCategoryRepository->deleteSubSubCategory($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting sub-subcategory.', 'error', true, true);
        }
        return $this->responseRedirect('admin.sub-subcategory.index', 'Sub-Subcategory deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->subSubCategoryRepository->updateSubSubCategoryStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Sub-Subcategory status successfully updated'));
        }
    }
}