<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BannerContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    /**
     * @var BannerContract
     */
    protected $bannerRepository;

    /**
     * BannerController constructor.
     * 
     * @param BannerContract $bannerRepository
     */
    public function __construct(BannerContract $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->bannerRepository->listBanners();
        // dd($datas);
        $this->setPageTitle('Banner', 'List of all banners');
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Banner', 'Create Banner');
        return view('admin.banner.create');
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
            'short_description' =>  'required',
            // 'video' =>  'required',
        ]);

        $params = $request->except('_token');

        $data = $this->bannerRepository->createBanner($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating banner.', 'error', true, true);
        }
        return $this->responseRedirect('admin.banner.index', 'Banner has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->bannerRepository->findBannerById($id);

        $this->setPageTitle('Banner', 'Edit Banner : ' . $data->title);
        return view('admin.banner.edit', compact('data'));
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
            'short_description' =>  'required',
            // 'video' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->bannerRepository->updateBanner($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating banner.', 'error', true, true);
        }
        return $this->responseRedirectBack('Banner updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->bannerRepository->deleteBanner($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting banner.', 'error', true, true);
        }
        return $this->responseRedirect('admin.banner.index', 'Banner deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->bannerRepository->updateBannerStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Banner status successfully updated'));
        }
    }
}