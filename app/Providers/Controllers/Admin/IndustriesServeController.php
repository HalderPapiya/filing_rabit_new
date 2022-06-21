<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\IndustriesServeContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class IndustriesServeController extends BaseController
{
    /**
     * @var IndustriesServeContract
     */
    protected $industriesServeRepository;

    /**
     * IndustriesServeController constructor.
     * 
     * @param IndustriesServeContract $industriesServeRepository
     */
    public function __construct(IndustriesServeContract $industriesServeRepository)
    {
        $this->industriesServeRepository = $industriesServeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->industriesServeRepository->listIndustriesServes();
        // dd($datas);
        $this->setPageTitle('Industries Serve', 'List of all Industries Serves');
        return view('admin.industries_serve.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Industries Serve', 'Create Industries Serve');
        return view('admin.industries_serve.create');
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
            'image' =>  'required|mimes:jpeg,img,jpg,svg,png',
        ]);

        $params = $request->except('_token');

        $data = $this->industriesServeRepository->createIndustriesServe($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating industries serve.', 'error', true, true);
        }
        return $this->responseRedirect('admin.industries_serve.index', 'industries serve has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->industriesServeRepository->findIndustriesServeById($id);

        $this->setPageTitle('Industries Serve', 'Edit Industries Serve : ' . $data->title);
        return view('admin.industries_serve.edit', compact('data'));
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
            'image' =>  'required|mimes:jpeg,img,jpg,svg,png',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->industriesServeRepository->updateIndustriesServe($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating industries serve.', 'error', true, true);
        }
        return $this->responseRedirectBack('Industries Serve updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->industriesServeRepository->deleteIndustriesServe($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting industries serve.', 'error', true, true);
        }
        return $this->responseRedirect('admin.industries_serve.index', 'Industries Serve deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->industriesServeRepository->updateIndustriesServeStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Industries Serve status successfully updated'));
        }
    }
}