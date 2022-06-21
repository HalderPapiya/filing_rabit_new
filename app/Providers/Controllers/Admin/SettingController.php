<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SettingContract;
use App\Http\Controllers\BaseController;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * @var SettingContract
     */
    protected $settingRepository;

    /**
     * SettingsUsController constructor.
     * 
     * @param SettingContract $settingRepository
     */
    public function __construct(SettingContract $settingRepository, ProductRepository $productRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->settingRepository->listSettings();
        // dd($datas);
        $this->setPageTitle('Settings', 'List of all settings');
        return view('admin.settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Settings', 'Create Contact');

        $listProducts = $this->productRepository->listProducts('id', 'DESC', ['id', 'name']);

        // dd($listProducts);

        return view('admin.settings.create', compact('listProducts'));
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
            'key' =>  'required',
            'product_id' =>  'required',
            'description' =>  'required',
        ]);

        $params = $request->except('_token');

        $data = $this->settingRepository->createSettings($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating settings.', 'error', true, true);
        }
        return $this->responseRedirect('admin.setting.index', 'Settings has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->settingRepository->findSettingsById($id);

        $this->setPageTitle('Settings', 'Edit Settings : ' . $data->title);
        return view('admin.settings.edit', compact('data'));
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
            'key' =>  'required',
            'description' =>  'required',
            'product_id' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->settingRepository->updateSettings($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating settings.', 'error', true, true);
        }
        return $this->responseRedirectBack('Settings updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->settingRepository->deleteSettings($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting settings.', 'error', true, true);
        }
        return $this->responseRedirect('admin.setting.index', 'Settings Us deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->settingRepository->updateSettingsStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Settings status successfully updated'));
        }
    }
}