<?php

namespace App\Http\Controllers\User;

use App\Contracts\BusinessServiceContract;
use App\Contracts\BusinessTypeContract;
use App\Http\Controllers\BaseController;
use App\Models\Bid;
use App\Models\BusinessAddOn;
use App\Models\BusinessService;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BusinessServiceController extends BaseController
{

    /**
     * @var BusinessServiceContract
     */
    // protected $businessServiceRepository;
    // protected $subCategoryRepository;
    // protected $userRepository;

    /**
     * BusinessServiceController constructor.
     * 
     * @param BusinessServiceContract $BusinessServiceRepository
     */
    public function __construct(BusinessServiceContract $businessServiceRepository, BusinessTypeContract $businessTypeRepository)
    {
        $this->businessServiceRepository = $businessServiceRepository;
        $this->businessTypeRepository = $businessTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $exist = Bid::where('user_id', Auth::user()->id)->exists();

    //     // $business = BusinessService::where('user_id',  Auth::guard('user')->user()->id)->first();
    //     // $businessId = $business->id;
    //     // dd($businessId);
    //     if (!empty($request->term)) {
    //         $businessServices = $this->businessServiceRepository->getSearchBusinesses($request->term);
    //     } else {
    //         $businessServices  = $this->businessServiceRepository->listBusinessServices();
    //     }

    //     // dd($businessServices);
    //     $this->setPageTitle('Business Service', 'List of All Business Services');
    //     return view('user.business.index', compact('businessServices', 'exist'));
    // }
    public function newBusiness()
    {
        return view('user.business_new.index');
    }
    public function showNewBusiness()
    {
        return view('user.business_new.show');
    }
    public function index(Request $request)
    {
        $term = (isset($request->name) && $request->name != '') ? $request->name : '';
        $valuation = (isset($request->valuation) && $request->valuation != '') ? $request->valuation : '';
        $typeId = (isset($request->type_id) && $request->type_id != '') ? $request->type_id : '';

        $businessServices = $this->businessServiceRepository->getSearchBusinesses($term, $typeId, $valuation);

        $types = BusinessType::get();

        return view('user.business.showAll', compact('businessServices', 'types'));
    }
    public function myBusiness(Request $request)
    {
        // dd($request->name);


        // $term = (isset($request->name) && $request->name != '') ? $request->name : '';
        // $valuation = (isset($request->valuation) && $request->valuation != '') ? $request->valuation : '';
        // $typeId = (isset($request->type_id) && $request->type_id != '') ? $request->type_id : '';


        // $businessServices = $this->businessServiceRepository->getSearchBusinesses($term, $typeId, $valuation);
        // return gettype(Auth::guard('user')->user()->id);
        $businessServices = $this->businessServiceRepository->findBusinessByUserId(Auth::guard('user')->user()->id);
        // return $businessServices;
        // dd($businessServices);
        $types = BusinessType::get();
        $exist = Bid::where('user_id', Auth::user()->id)->exists();
        $this->setPageTitle('Blog List', 'List of blogs');
        return view('user.business.index', compact('businessServices', 'types', 'exist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        $this->setPageTitle('Business Service', 'Create A New Business Service');
        return view('user.business.add', compact('businessTypes'));
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
            'name' =>  'required',
            'type_id' =>  'required',
            'valuation' =>  'required',
            'description' => 'required',
        ]);
        $params = $request->except('_token');

        $businessService = $this->businessServiceRepository->createBusinessServices($params);

        if (!$businessService) {
            return $this->responseRedirectBack('Error occurred while creating Business Service.', 'error', true, true);
        }
        return Redirect::back()->with('success', 'Listing successfully.');
        // return $this->responseRedirect('user.businessService.create', 'Business Service has been added successfully', 'success', false, false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $businessService = $this->businessServiceRepository->findBusinessServiceById($id);
        // $categories = $this->categoryRepository->listCategories();
        // $subcategories = $this->subCategoryRepository->listSubCategories();
        // $packages = $this->PackageRepository->listPackages();
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Edit Business Service : ' . $businessService->title);
        return view('user.business.edit', compact('businessService', 'businessTypes'));
    }
    public function show($id)
    {
        $businessService = $this->businessServiceRepository->findBusinessServiceById($id);
        // $categories = $this->categoryRepository->listCategories();
        // $subcategories = $this->subCategoryRepository->listSubCategories();
        // $packages = $this->PackageRepository->listPackages();
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Show Business Service : ' . $businessService->title);

        $businessAddOns = BusinessAddOn::where('business_id', $id)->with('addOn')->get();
        return view('user.business.show_details', compact('businessService', 'businessTypes', 'businessAddOns'));
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
            'name' =>  'required',
            'type_id' =>  'required',
            'valuation' =>  'required',
        ]);

        $params = $request->except('_token');

        if (!array_key_exists('status', $params)) $params['status'] = 0;
        // dd($params);
        // die;

        $businessService = $this->businessServiceRepository->updateBusinessService($params);

        if (!$businessService) {
            return $this->responseRedirectBack('Error occurred while updating Business Service.', 'error', true, true);
        }
        return $this->responseRedirect('user.businessService.myBusiness', 'Business Service updated successfully', 'success', false, false);
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
