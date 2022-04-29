<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SubCategoryController extends BaseController
{
    /**
     * @var SubCategoryContract
     */
    // protected $categoryRepository;
    // protected $subCategoryRepository;

    /**
     * SubCategoryController constructor.
     * 
     * @param SubCategoryContract $subCategoryRepository
     */
    public function __construct(SubCategoryContract $subCategoryRepository, CategoryContract $categoryRepository)
    {
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
        $subCategories = $this->subCategoryRepository->listSubCategories();


        $this->setPageTitle('Subcategory', 'List of all subcategories');
        return view('admin.sub_category.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories();
        $this->setPageTitle('Subcategory', 'Create Subcategory');
        return view('admin.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            'categoryId' =>  'required',
        ]);

        $params = $request->except('_token');

        $subCategory = $this->subCategoryRepository->createSubCategory($params);

        if (!$subCategory) {
            return $this->responseRedirectBack('Error occurred while creating subcategory.', 'error', true, true);
        }
        return $this->responseRedirect('admin.subcategory.index', 'Subcategory has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->listCategories();
        $data = $this->subCategoryRepository->findSubCategoryById($id);

        $this->setPageTitle('Subcategory', 'Edit Subcategory : ' . $data->title);
        return view('admin.sub_category.edit', compact('data', 'categories'));
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

        $subCategory = $this->subCategoryRepository->updateSubCategory($params);

        if (!$subCategory) {
            return $this->responseRedirectBack('Error occurred while updating subcategory.', 'error', true, true);
        }
        return $this->responseRedirectBack('Subcategory updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $subCategory = $this->subCategoryRepository->deleteSubCategory($id);

        if (!$subCategory) {
            return $this->responseRedirectBack('Error occurred while deleting subcategory.', 'error', true, true);
        }
        return $this->responseRedirect('admin.subcategory.index', 'Subcategory deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $subCategory = $this->subCategoryRepository->updateSubCategoryStatus($params);

        if ($subCategory) {
            return response()->json(array('message' => 'Subcategory status successfully updated'));
        }
    }
}