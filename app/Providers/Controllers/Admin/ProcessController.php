<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProcessContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProcessController extends BaseController
{
    /**
     * @var processContract
     */
    protected $processRepository;

    /**
     * ProcessController constructor.
     * 
     * @param processContract $processRepository
     */
    public function __construct(processContract $processRepository)
    {
        $this->processRepository = $processRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->processRepository->listProcess();
        // dd($blogs);
        $this->setPageTitle('Process', 'List of all process');
        return view('admin.process.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Process', 'Create Process');
        return view('admin.process.create');
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
            'description' =>  'required',
        ]);

        $params = $request->except('_token');

        $data = $this->processRepository->createProcess($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating process.', 'error', true, true);
        }
        return $this->responseRedirect('admin.process.index', 'Process has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->processRepository->findProcessById($id);

        $this->setPageTitle('Process', 'Edit Process : ' . $data->title);
        return view('admin.process.edit', compact('data'));
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
            'description' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->processRepository->updateProcess($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating process.', 'error', true, true);
        }
        return $this->responseRedirectBack('Process updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->processRepository->deleteProcess($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting process.', 'error', true, true);
        }
        return $this->responseRedirect('admin.process.index', 'Process deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->processRepository->updateProcessStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Process status successfully updated'));
        }
    }
}