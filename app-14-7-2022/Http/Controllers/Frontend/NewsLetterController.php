<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\NewsLetterContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class NewsLetterController extends BaseController
{
    /**
     * @var NewsLetterContract
     */
    protected $newsLetterRepository;

    /**
     * NewsLetterController constructor.
     * 
     * @param NewsLetterContract $newsLetterRepository
     */
    public function __construct(NewsLetterContract $newsLetterRepository)
    {
        $this->newsLetterRepository = $newsLetterRepository;
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
            'email' =>  'required',
        ]);

        $params = $request->except('_token');

        $data = $this->newsLetterRepository->createNewsLetter($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating News Letter.', 'error', true, true);
        }else{
        // return back()->with('Success', 'Subscribed successFully');
        return $this->responseRedirectBack('Subscribed successFully.', 'success', false, false);
            
        }
        
        // return view('frontend.news_letter');
        // return $this->responseRedirect('frontend.news_letter', 'News Letter has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    // public function edit($id)
    // {
    //     $data = $this->newsLetter->findNewsLetterById($id);

    //     $this->setPageTitle('News Letter', 'Edit News Letter : ' . $data->title);
    //     return view('admin.why_us.edit', compact('data'));
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function update(Request $request)
    // {
    //     $this->validate($request, [
    //         'title' =>  'required',
    //         'description' =>  'required',
    //     ]);

    //     $params = $request->except('_token');

    //     //dd($params);

    //     $data = $this->newsLetter->updateNewsLetter($params);

    //     if (!$data) {
    //         return $this->responseRedirectBack('Error occurred while updating News Letter.', 'error', true, true);
    //     }
    //     return $this->responseRedirectBack('News Letter updated successfully', 'success', false, false);
    // }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function destroy($id)
    // {
    //     $data = $this->newsLetter->deleteNewsLetter($id);

    //     if (!$data) {
    //         return $this->responseRedirectBack('Error occurred while deleting News Letter.', 'error', true, true);
    //     }
    //     return $this->responseRedirect('admin.why-us.index', 'News Letter deleted successfully', 'success', false, false);
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function updateStatus(Request $request)
    // {

    //     $params = $request->except('_token');

    //     $data = $this->newsLetter->updateNewsLetterStatus($params);

    //     if ($data) {
    //         return response()->json(array('message' => 'News Letter status successfully updated'));
    //     }
    // }
}