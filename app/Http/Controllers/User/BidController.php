<?php

namespace App\Http\Controllers\User;

use App\Contracts\BidContract;
use App\Contracts\BusinessServiceContract;
use App\Contracts\BusinessTypeContract;
use App\Http\Controllers\BaseController;
use App\Models\Bid;
use App\Models\BusinessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BidController extends BaseController
{

    /**
     * @var BidContract
     */
    // protected $bidRepository;
    // protected $subCategoryRepository;
    // protected $userRepository;

    /**
     * BidController constructor.
     * 
     * @param BidContract $BusinessServiceRepository
     */
    public function __construct(BidContract $bidRepository, BusinessServiceContract $businessServiceRepository)
    {
        $this->bidRepository = $bidRepository;
        $this->businessServiceRepository = $businessServiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids  = $this->bidRepository->listBids();

        $this->setPageTitle('Bid', 'List of All Bids');
        return view('user.bid.index', compact('bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        // dd($exist);
        $businessService = $this->businessServiceRepository->findBusinessServiceById($id);
        // $business = $this->businessServiceRepository->findBusinessServiceById();
        // $categories = $this->categoryRepository->listCategories();
        // $subcategories = $this->subCategoryRepository->listSubCategories();
        // $packages = $this->PackageRepository->listPackages();
        $business  = $this->businessServiceRepository->listBusinessServices();

        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        $this->setPageTitle('Bid', 'Create A New Bid');
        // if (!$exist) {
        return view('user.bid.add', compact('businessService', 'business'));
        // }
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

        $bid = $this->bidRepository->createBid($params);

        if (!$bid) {
            return $this->responseRedirectBack('Error occurred while creating Bid.', 'error', true, true);
        }
        return $this->responseRedirect('user.businessService.index', 'Bid added successfully', 'success', false, false);
        // return $this->responseRedirectBack('Bid has been added successfully', 'success', false, false);
        // return $this->responseRedirectBack('Bid has been added successfully', 'success', false, false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $businessService = $this->businessServiceRepository->findBusinessServiceById($id);
        $bid = $this->bidRepository->findBidById($id);
        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Edit Bid : ' . $bid->title);
        return view('user.bid.edit', compact('bid'));
    }
    public function show($id)
    {


        $bid = $this->bidRepository->findBusinessServiceById($id);
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
            // 'name' =>  'required',
            // 'type_id' =>  'required',
            'valuation' =>  'required',
        ]);

        $params = $request->except('_token');



        $bid = $this->bidRepository->updateBid($params);

        if (!$bid) {
            return $this->responseRedirectBack('Error occurred while updating Bid.', 'error', true, true);
        }
        return Redirect::back()->with('success', 'Update successfully.');
        // return $bid;
        // return $this->responseRedirectBack('Bid updated successfully', 'success', false, false);
    }


    public function destroy($id)
    {
        $BusinessService = $this->bidRepository->deleteBusinessService($id);

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

        $BusinessService = $this->bidRepository->updateBusinessServiceStatus($params);

        if ($BusinessService) {
            return response()->json(array('message' => 'Bid  status successfully updated'));
        }
    }
}