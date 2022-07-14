<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ConsultantContract;
use App\Contracts\NewsLetterContract;
use App\Http\Controllers\BaseController;
use App\Models\Consultant;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
    /**
     * @var NewsLetterContract
     */
    protected $newsLetterRepository;
    protected $consultantRepository;

    /**
     * WhyUsController constructor.
     * 
     * @param NewsLetterContract $whyUsRepository
     */
    public function __construct(NewsLetterContract $newsLetterRepository , ConsultantContract $consultantRepository)
    {
        $this->newsLetterRepository = $newsLetterRepository;
        $this->consultantRepository = $consultantRepository;
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
        $this->setPageTitle('Report News Letter', 'List of All News Letters');
        return view('admin.report.news-letter', compact('data'));
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enquiryList()
    {
        $data = Enquiry::get();
        // dd($blogs);
        $this->setPageTitle('Report Enquiry', 'List of All Enquiries');
        return view('admin.report.enquiry', compact('data'));
    }
    public function consultantList()
    {
        $data = $this->consultantRepository->listConsultants();
        // dd($blogs);
        $this->setPageTitle('Report For Consultant Booking', 'List of All Consultant Booking');
        return view('admin.report.booking_consultant', compact('data'));
    }
   
}