<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BusinessTypeContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BusinessTypeController extends BaseController
{
    /**
     * @var businessTypeRepository
     */
    protected $businessTypeRepository;

    /**
     * BusinessTypeController constructor.
     * 
     * @param BusinessTypeContract $businessTypeRepository
     */
    public function __construct(BusinessTypeContract $businessTypeRepository)
    {
        $this->businessTypeRepository = $businessTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->businessTypeRepository->listBusinessTypes();
        $this->setPageTitle('Business Type', 'List of all business type');
        return view('admin.business_type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Business Type', 'Create business type');
        return view('admin.business_type.create');
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
        ]);

        $params = $request->except('_token');

        $data = $this->businessTypeRepository->createBusinessType($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating business type.', 'error', true, true);
        }
        return $this->responseRedirect('admin.business_type.index', 'Business type has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->businessTypeRepository->findBusinessTypeById($id);

        $this->setPageTitle('Business Type', 'Edit business type : ' . $data->title);
        return view('admin.business_type.edit', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->businessTypeRepository->updateBusinessType($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating business type.', 'error', true, true);
        }
        return $this->responseRedirect('admin.business_type.index', 'Business type updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->businessTypeRepository->deleteBusinessType($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting business type.', 'error', true, true);
        }
        return $this->responseRedirect('admin.pacbusiness_typekage.index', 'Business type deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->businessTypeRepository->updateBusinessTypeStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Business type status successfully updated'));
        }
    }
}