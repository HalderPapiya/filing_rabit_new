<?php

namespace App\Http\Controllers\User;

use App\Contracts\AddOnBidContract;
use App\Contracts\BidContract;
use App\Contracts\BusinessAddOnContract;
use App\Contracts\BusinessServiceContract;
use App\Contracts\BusinessTypeContract;
use App\Http\Controllers\BaseController;
use App\Models\BusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddOnBidController extends BaseController
{

    /**
     * @var AddOnBidContract
     */
    // protected $addOnBidRepository;
    // protected $subCategoryRepository;
    // protected $userRepository;

    /**
     * AddOnBidController constructor.
     * 
     * @param AddOnBidContract $BusinessServiceRepository
     */
    public function __construct(AddOnBidContract $addOnBidRepository, BusinessAddOnContract $businessAddOnRepository, BusinessServiceContract $businessServiceRepository)
    {
        $this->addOnBidRepository = $addOnBidRepository;
        $this->businessAddOnRepository = $businessAddOnRepository;
        $this->businessServiceRepository = $businessServiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids  = $this->addOnBidRepository->listBusinessServices();
        $this->setPageTitle('Bid', 'List of All Bids');
        return view('user.business.index', compact('bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $businessService = $this->businessServiceRepository->findBusinessServiceById($id);
        // dd($businessService);

        $businessAddOn = $this->businessAddOnRepository->findBusinessAddOnById($id);
        // dd($businessAddOn);
        // $business = $this->businessServiceRepository->findBusinessServiceById();
        // $categories = $this->categoryRepository->listCategories();
        // $subcategories = $this->subCategoryRepository->listSubCategories();
        // $packages = $this->PackageRepository->listPackages();
        $business  = $this->businessAddOnRepository->listBusinessAddOns();

        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        $this->setPageTitle('Add-On Bid', 'Create A New Add-On Bid');
        return view('user.add_on_bid.add', compact('business', 'businessAddOn'));
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

            'valuation' =>  'required',
        ]);

        $params = $request->except('_token');

        $bidAddOn = $this->addOnBidRepository->createAddOnBid($params);

        if (!$bidAddOn) {
            return $this->responseRedirectBack('Error occurred while creating Bid.', 'error', true, true);
        }
        // return $this->responseRedirect('user.businessService.index', 'Bid added successfully', 'success', false, false);
        // // return $this->responseRedirectBack('Bid has been added successfully', 'success', false, false);
        return $this->responseRedirectBack('Bid has been added successfully', 'success', false, false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $bid = $this->addOnBidRepository->findBusinessAddOnById($id);
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Edit Bid : ' . $bid->title);
        return view('user.business.edit', compact('bid', 'businessTypes'));
    }
    public function show($id)
    {


        $bid = $this->addOnBidRepository->findBusinessAddOnById($id);
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Show Bid : ' . $bid->title);
        return view('user.business.show', compact('bid', 'businessTypes'));
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



        $bid = $this->addOnBidRepository->updateBusinessService($params);

        if (!$bid) {
            return $this->responseRedirectBack('Error occurred while updating Bid.', 'error', true, true);
        }
        return $this->responseRedirect('user.bid.index', 'Bid updated successfully', 'success', false, false);
    }


    public function destroy($id)
    {
        $BusinessService = $this->addOnBidRepository->deleteBusinessService($id);

        if (!$BusinessService) {
            return $this->responseRedirectBack('Error occurred while deleting Bid.', 'error', true, true);
        }
        return $this->responseRedirect('admin.bid.index', 'Bid deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $BusinessService = $this->addOnBidRepository->updateBusinessServiceStatus($params);

        if ($BusinessService) {
            return response()->json(array('message' => 'Bid  status successfully updated'));
        }
    }
}