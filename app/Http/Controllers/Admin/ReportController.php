<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\NewsLetterContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
    /**
     * @var NewsLetterContract
     */
    protected $newsLetterRepository;

    /**
     * WhyUsController constructor.
     * 
     * @param NewsLetterContract $whyUsRepository
     */
    public function __construct(NewsLetterContract $newsLetterRepository)
    {
        $this->newsLetterRepository = $newsLetterRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsLetterList()
    {
        $data = $this->newsLetterRepository->listNewsLetters();
        // dd($blogs);
        $this->setPageTitle('Report News Letter', 'List of all News Letters');
        return view('admin.report.news-letter', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Why Us', 'Create Why Us');
        return view('admin.why_us.create');
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
            'image' =>  'required|mimes:jpeg,img,jpg,svg,png',
        ]);

        $params = $request->except('_token');

        $data = $this->whyUsRepository->createWhyUs($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating why us.', 'error', true, true);
        }
        return $this->responseRedirect('admin.why-us.index', 'Why us has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->whyUsRepository->findWhyUsById($id);

        $this->setPageTitle('Why Us', 'Edit Why Us : ' . $data->title);
        return view('admin.why_us.edit', compact('data'));
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

        $data = $this->whyUsRepository->updateWhyUs($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating why us.', 'error', true, true);
        }
        return $this->responseRedirectBack('Why us updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->whyUsRepository->deleteWhyUs($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting why us.', 'error', true, true);
        }
        return $this->responseRedirect('admin.why-us.index', 'Why us deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->whyUsRepository->updateWhyUsStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Why us status successfully updated'));
        }
    }
}