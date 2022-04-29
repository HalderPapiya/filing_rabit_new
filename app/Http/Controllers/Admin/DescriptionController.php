<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\DescriptionContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DescriptionController extends BaseController
{
    /**
     * @var DescriptionContract
     */
    protected $descriptionRepository;

    /**
     * DescriptionController constructor.
     * 
     * @param DescriptionContract $descriptionRepository
     */
    public function __construct(DescriptionContract $descriptionRepository,  ProductContract $productRepository)
    {
        $this->descriptionRepository = $descriptionRepository;
        $this->productRepository = $productRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->descriptionRepository->listDescriptions();
        $this->setPageTitle('Description', 'List of all description');
        return view('admin.description.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->listProducts();
        $this->setPageTitle('Description', 'Create Description');
        return view('admin.description.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' =>  'required',
        //     'price' =>  'required',
        // ]);

        $params = $request->except('_token');

        $data = $this->descriptionRepository->createDescription($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating description.', 'error', true, true);
        }
        return $this->responseRedirect('admin.description.index', 'Description has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $products = $this->productRepository->listProducts();
        $data = $this->descriptionRepository->findDescriptionById($id);

        $this->setPageTitle('Description', 'Edit description : ' . $data->title);
        return view('admin.description.edit', compact('data', 'products'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'name' =>  'required',
        //     'price' =>  'required',
        // ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->descriptionRepository->updateDescription($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating description.', 'error', true, true);
        }
        return $this->responseRedirect('admin.description.index', 'Description updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->descriptionRepository->deleteDescription($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting description.', 'error', true, true);
        }
        return $this->responseRedirect('admin.description.index', 'Description deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->descriptionRepository->updateDescriptionStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Description status successfully updated'));
        }
    }
}