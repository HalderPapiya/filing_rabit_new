<?php

namespace App\Http\Controllers\User;

use App\Contracts\BidContract;
use App\Contracts\BusinessAddOnContract;
use App\Contracts\BusinessServiceContract;
use App\Contracts\BusinessTypeContract;
use App\Http\Controllers\BaseController;
use App\Models\Bid;
use App\Models\BidAddOn;
use App\Models\BrokerChat;
use App\Models\BusinessAddOn;
use App\Models\BusinessService;
use Dotenv\Regex\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BrokerController extends BaseController
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
    public function __construct(BidContract $bidRepository, BusinessServiceContract $businessServiceRepository, BusinessAddOnContract $businessAddOnRepository)
    {
        $this->bidRepository = $bidRepository;
        $this->businessServiceRepository = $businessServiceRepository;
        $this->businessAddOnRepository = $businessAddOnRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessServices  = $this->businessServiceRepository->listBusinessServices();
        // $this->setPageTitle('Bid', 'List of All Bids');
        return view('user.broker.business_list', compact('businessServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $businessService = $this->businessServiceRepository->findBusinessServiceById($id);
        // $business = $this->businessServiceRepository->findBusinessServiceById();
        // $categories = $this->categoryRepository->listCategories();
        // $subcategories = $this->subCategoryRepository->listSubCategories();
        // $packages = $this->PackageRepository->listPackages();
        $business  = $this->businessServiceRepository->listBusinessServices();

        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        $this->setPageTitle('Bid', 'Create A New Bid');
        return view('user.bid.add', compact('businessService', 'business'));
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


        $bid = $this->bidRepository->findBusinessServiceById($id);
        $businessTypes  = $this->businessTypeRepository->listBusinessTypes();

        $this->setPageTitle('business Service', 'Edit Bid : ' . $bid->title);
        return view('user.business.edit', compact('bid', 'businessTypes'));
    }
    public function show($id)
    {
        // $bid = $this->bidRepository->findBidById($id);
        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        // $bid=0;
        $bids = Bid::where('business_id', $id)->with('user')->get();
        // dd($bids);
        $this->setPageTitle('business Service', 'Edit Bid : ');
        // dd(json_encode($bids[0]));
        return view('user.broker.business_bid', compact('bids'));
    }
    public function showAddon($id)
    {
        // $bid = $this->bidRepository->findBidById($id);
        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        // $bid=0;
        // $businessAddOns  = $this->businessAddOnRepository->listBusinessAddOns();
        $businessAddOns = BusinessAddOn::where('business_id', $id)->get();
        // dd($bids);
        $this->setPageTitle('business Service', 'Edit Bid : ');
        return view('user.broker.add_on_list', compact('businessAddOns'));
    }

    public function showAddonBid($id)
    {
        // $bid = $this->bidRepository->findBidById($id);
        // $businessTypes  = $this->businessTypeRepository->listBusinessTypes();
        // $bid=0;
        // $businessAddOns  = $this->businessAddOnRepository->listBusinessAddOns();
        // $businessAddOns = BusinessAddOn::get();
        // dd($businessAddOns->id);

        $bids = BidAddOn::where('add_on_id', $id)->get();
        // dd($bids);
        $this->setPageTitle('business Service', 'Edit Bid : ');
        return view('user.broker.add_on_bid_list', compact('bids'));
    }
    public function mail($id)
    {
        $senderId = Auth::user()->id;
        $senderMails = BrokerChat::where('sender_id', $senderId)->get();


        // $senderId = Auth::user()->id;
        // $senderMails = BrokerChat::where('sender_id', $senderId)->get();

        $bid = $this->bidRepository->findBidById($id);

        // $receiverId = Auth::user()->id;
        $receiveMails = BrokerChat::where('receiver_id', $bid->user_id)->get();
        // dd($receiveMails);
        return view('user.broker.business_bid_mail', compact('bid', 'receiveMails', 'senderMails'));
    }

    protected function createBidMail($id)
    {
        $bid = $this->bidRepository->findBidById($id);
        // dd($bid);
        // $bids = Bid::where('business_id', $id)->get();
        // $bids = Bid::where('business_id', $id)->get();
        // $this->setPageTitle('business Service', 'Edit Bid : ');
        return view('user.broker.bid_mail_create', compact('bid'));
    }
    protected function storeBidMail(Request $request)
    {
        $user = new BrokerChat;
        $user->receiver_id = $request->receiver_id;
        $user->sender_id = Auth::user()->id;
        $user->subject = $request->subject;
        $user->message = $request->message;
        $user->save();

        if (!$user) {
            return $this->responseRedirectBack('Error occurred while creating blog.', 'error', true, true);
        }
        return Redirect::back()->with('message', 'Mail Send successfully.');

        // return $this->responseRedirectBack( ['Session' => 'Registered successfully','Success' , false, false]);
    }

    public function AddOnMail($id)
    {
        $bid = BusinessAddOn::findOrFail($id);

        // $bid = $this->bidRepository->findBidById($id);
        // dd($bid);
        // $bids = Bid::where('business_id', $id)->get();
        // $bids = Bid::where('business_id', $id)->get();
        // $this->setPageTitle('business Service', 'Edit Bid : ');
        return view('user.broker.business_bid_mail', compact('bid'));
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



        $bid = $this->bidRepository->updateBusinessService($params);

        if (!$bid) {
            return $this->responseRedirectBack('Error occurred while updating Bid.', 'error', true, true);
        }
        return $this->responseRedirect('user.bid.index', 'Bid updated successfully', 'success', false, false);
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
