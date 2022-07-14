<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\ContactUsContract;
use App\Contracts\SettingContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PolicyController extends BaseController
{

    /**
     * PolicyController constructor.
     *
     * @param SettingContract $settingRepository
     */
    public function __construct(
        SettingContract $settingRepository,
        ContactUsContract $contactUsRepository
    ) {
        $this->settingRepository = $settingRepository;
        $this->contactUsRepository = $contactUsRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function privacyPolicy()
    {
        $contact = $this->contactUsRepository->latestContactUs();
        $privacy = $this->settingRepository->privacyPolicy();

        // dd($privacy);
        return view('frontend.privacy_policy', compact('privacy', 'contact'));
    }

    public function termsConditions()
    {
        $contact = $this->contactUsRepository->latestContactUs();
        $terms = $this->settingRepository->termsConditions();

        // dd($privacy);
        return view('frontend.terms_and_conditions', compact('terms', 'contact'));
    }
    public function refundPolicy()
    {
        $refundPolicies = $this->settingRepository->refundPolicy();

        // dd($privacy);
        return view('frontend.refund_policy', compact('refundPolicies'));
    }

    public function disclaimerPolicy()
    {
        $disclaimerPolicies = $this->settingRepository->disclaimerPolicy();

        // dd($privacy);
        return view('frontend.disclaimer_policy', compact('disclaimerPolicies'));
    }
    public function confidentialStatements()
    {
        $conStatements = $this->settingRepository->confidentialStatement();

        // dd($privacy);
        return view('frontend.confidential_statement', compact('conStatements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}