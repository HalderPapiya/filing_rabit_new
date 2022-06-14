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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enquiryList()
    {
        $data = $this->newsLetterRepository->listNewsLetters();
        // dd($blogs);
        $this->setPageTitle('Report News Letter', 'List of all News Letters');
        return view('admin.report.news-letter', compact('data'));
    }
   
}