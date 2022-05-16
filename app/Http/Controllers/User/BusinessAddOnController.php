<?php

namespace App\Http\Controllers\User;

use App\Contracts\BusinessAddOnContract;
use App\Contracts\BusinessTypeContract;
use App\Contracts\BusinessServiceContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BusinessAddOnController extends BaseController
{

    /**
     * @var BusinessAddOnContract
     */
    // protected $businessAddOnRepository;
    // protected $subCategoryRepository;
    // protected $userRepository;

    /**
     * BusinessAddOnController constructor.
     * 
     * @param BusinessAddOnContract $businessAddOnRepository
     */
    public function __construct(BusinessAddOnContract $businessAddOnRepository, BusinessServiceContract $businessServiceRepository)
    {
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
        $businessAddOns  = $this->businessAddOnRepository->listBusinessAddOns();
        // dd($businessAddOns);
        $this->setPageTitle('business add on', 'List of All business add ons');
        return view('user.business_add_on.index', compact('businessAddOns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $businessServices  = $this->businessServiceRepository->listBusinessServices();
        $this->setPageTitle('business add on', 'Create A New business add on');
        return view('user.business_add_on.add', compact('businessServices'));
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
            'business_id' =>  'required',
            'valuation' =>  'required',
        ]);

        $params = $request->except('_token');

        $businessAddOn = $this->businessAddOnRepository->createBusinessAddOn($params);

        if (!$businessAddOn) {
            return $this->responseRedirectBack('Error occurred while creating business add on.', 'error', true, true);
        }
        return $this->responseRedirect('user.business_add_on.create', 'business add on has been added successfully', 'success', false, false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $businessAddOn = $this->businessAddOnRepository->findBusinessAddOnById($id);
        $businessServices  = $this->businessServiceRepository->listBusinessServices();

        $this->setPageTitle('business add on', 'Edit business add on : ' . $businessAddOn->title);
        return view('user.business_add_on.edit', compact('businessAddOn','businessServices'));
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
            'business_id' =>  'required',
            'valuation' =>  'required'
        ]);

        $params = $request->except('_token');



        $businessAddOn = $this->businessAddOnRepository->updateBusinessAddOn($params);

        if (!$businessAddOn) {
            return $this->responseRedirectBack('Error occurred while updating business add on.', 'error', true, true);
        }
        return $this->responseRedirect('user.business_add_on.index', 'business add on updated successfully', 'success', false, false);
    }


    public function destroy($id)
    {
        $businessAddOn = $this->businessAddOnRepository->deleteBusinessAddOn($id);

        if (!$businessAddOn) {
            return $this->responseRedirectBack('Error occurred while deleting business add on.', 'error', true, true);
        }
        return $this->responseRedirect('admin.business_add_on.index', 'business add on deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $businessAddOn = $this->businessAddOnRepository->updateBusinessAddOnStatus($params);

        if ($businessAddOn) {
            return response()->json(array('message' => 'business add on  status successfully updated'));
        }
    }
}