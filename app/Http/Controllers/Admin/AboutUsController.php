<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AboutUsContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class AboutUsController extends BaseController
{
    /**
     * @var AboutUsContract
     */
    protected $aboutUsRepository;

    /**
     * ContactUsController constructor.
     * 
     * @param AboutUsContract $aboutUsRepository
     */
    public function __construct(AboutUsContract $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->aboutUsRepository->listAboutUs();
        // dd($datas);
        $this->setPageTitle('About Us', 'List of all about us');
        return view('admin.about_us.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('About Us', 'Create About Us');
        return view('admin.about_us.create');
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
        ]);

        $params = $request->except('_token');

        $data = $this->aboutUsRepository->createAboutUs($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating about us.', 'error', true, true);
        }
        return $this->responseRedirect('admin.about-us.index', 'About Us has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->aboutUsRepository->findAboutUsById($id);

        $this->setPageTitle('About Us', 'Edit About Us : ' . $data->title);
        return view('admin.about_us.edit', compact('data'));
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
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->aboutUsRepository->updateAboutUs($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating about us.', 'error', true, true);
        }
        return $this->responseRedirectBack('About Us updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->aboutUsRepository->deleteAboutUs($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting about us.', 'error', true, true);
        }
        return $this->responseRedirect('admin.about-us.index', 'About Us deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->aboutUsRepository->updateAboutUsStatus($params);

        if ($data) {
            return response()->json(array('message' => 'About Us status successfully updated'));
        }
    }
}