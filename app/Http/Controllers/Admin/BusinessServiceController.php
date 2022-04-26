<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BusinessServiceContract;
use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Contracts\PackageContract;
use App\Contracts\UserContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BusinessServiceController extends BaseController
{

    /**
     * @var BusinessServiceContract
     */
    // protected $categoryRepository;
    // protected $subCategoryRepository;
    // protected $userRepository;

    /**
     * BusinessServiceController constructor.
     * 
     * @param BusinessServiceContract $BusinessServiceRepository
     */
    public function __construct(BusinessServiceContract $businessServiceRepository, SubCategoryContract $subCategoryRepository, CategoryContract $categoryRepository, UserContract $userRepository, PackageContract $PackageRepository)
    {
        $this->businessServiceRepository = $businessServiceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->PackageRepository = $PackageRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessServices = $this->businessServiceRepository->listBusinessServices();

        $this->setPageTitle('Business Service', 'List of All Business Services');
        return view('admin.business_service.index', compact('businessServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories();
        $subcategories = $this->subCategoryRepository->listSubCategories();
        $packages = $this->PackageRepository->listPackages();
        $this->setPageTitle('Business Service', 'create a New Data');
        return view('admin.business_service.create', compact('categories', 'subcategories', 'packages'));
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
            'subcategoryId' =>  'required',
            'packageId' =>  'required',
        ]);

        $params = $request->except('_token');

        $businessService = $this->businessServiceRepository->createBusinessServices($params);

        if (!$businessService) {
            return $this->responseRedirectBack('Error occurred while creating Business Service.', 'error', true, true);
        }
        return $this->responseRedirect('admin.businessService.index', 'Business Service has been added successfully', 'success', false, false);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $businessServices = $this->businessServiceRepository->findBusinessServiceById($id);
        $categories = $this->categoryRepository->listCategories();
        $subcategories = $this->subCategoryRepository->listSubCategories();
        $packages = $this->PackageRepository->listPackages();


        $this->setPageTitle('business Service', 'Edit Business Service : ' . $businessServices->title);
        return view('admin.business_service.edit', compact('businessServices', 'categories', 'subcategories', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $this->validate($request, [
                'title' =>  'required',
            ]);
    
            $params = $request->except('_token');
    
            
    
            $businessService = $this->businessServiceRepository->updateBusinessService($params);
    
            if (!$businessService) {
                return $this->responseRedirectBack('Error occurred while updating Business Service.', 'error', true, true);
            }
            return $this->responseRedirectBack('Business Service updated successfully', 'success', false, false);
    }


    public function destroy($id)
    {
        $BusinessService = $this->businessServiceRepository->deleteBusinessService($id);

        if (!$BusinessService) {
            return $this->responseRedirectBack('Error occurred while deleting Business Service.', 'error', true, true);
        }
        return $this->responseRedirect('admin.business_service.index', 'Business Service deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $BusinessService = $this->businessServiceRepository->updateBusinessServiceStatus($params);

        if ($BusinessService) {
            return response()->json(array('message' => 'Business Service  status successfully updated'));
        }
    }
}
