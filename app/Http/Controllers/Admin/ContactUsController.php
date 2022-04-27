<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ContactUsContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ContactUsController extends BaseController
{
    /**
     * @var ContactUsContract
     */
    protected $contactUsRepository;

    /**
     * ContactUsController constructor.
     * 
     * @param ContactUsContract $contactUsRepository
     */
    public function __construct(ContactUsContract $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->contactUsRepository->listContactUs();
        // dd($datas);
        $this->setPageTitle('Contact Us', 'List of all contact us');
        return view('admin.contact_us.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Contact Us', 'Create Contact Us');
        return view('admin.contact_us.create');
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

        $data = $this->contactUsRepository->createContactUs($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating contact us.', 'error', true, true);
        }
        return $this->responseRedirect('admin.contact-us.index', 'Contact Us has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->contactUsRepository->findContactUsById($id);

        $this->setPageTitle('Contact Us', 'Edit Contact Us : ' . $data->title);
        return view('admin.contact_us.edit', compact('data'));
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

        $data = $this->contactUsRepository->updateContactUs($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating contact us.', 'error', true, true);
        }
        return $this->responseRedirectBack('Contact Us updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->contactUsRepository->deleteContactUs($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting contact us.', 'error', true, true);
        }
        return $this->responseRedirect('admin.contact-us.index', 'Contact Us deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->contactUsRepository->updateContactUsStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Contact Us status successfully updated'));
        }
    }
}