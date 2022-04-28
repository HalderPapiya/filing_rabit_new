<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TestimonialContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class TestimonialController extends BaseController
{
    /**
     * @var testimonialContract
     */
    protected $testimonialRepository;

    /**
     * TestimonialController constructor.
     * 
     * @param testimonialContract $testimonialRepository
     */
    public function __construct(TestimonialContract $testimonialRepository)
    {
        $this->testimonialRepository = $testimonialRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->testimonialRepository->listTestimonials();
        // dd($datas);
        $this->setPageTitle('Testimonial', 'List of all Testimonials');
        return view('admin.testimonial.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Testimonial', 'Create Testimonial');
        return view('admin.testimonial.create');
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
            'description' =>  'required',
        ]);

        $params = $request->except('_token');

        $data = $this->testimonialRepository->createTestimonial($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating testimonial.', 'error', true, true);
        }
        return $this->responseRedirect('admin.testimonial.index', 'Testimonial has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->testimonialRepository->findTestimonialById($id);

        $this->setPageTitle('Testimonial', 'Edit Testimonial : ' . $data->title);
        return view('admin.testimonial.edit', compact('data'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'description' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->testimonialRepository->updateTestimonial($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating testimonial.', 'error', true, true);
        }
        return $this->responseRedirectBack('Testimonial updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->testimonialRepository->deleteTestimonial($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting testimonial.', 'error', true, true);
        }
        return $this->responseRedirect('admin.testimonial.index', 'Testimonial deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->testimonialRepository->updateTestimonialStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Testimonial status successfully updated'));
        }
    }
}