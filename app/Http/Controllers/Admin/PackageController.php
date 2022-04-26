<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\PackageContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PackageController extends BaseController
{
    /**
     * @var PackageContract
     */
    protected $packageRepository;

    /**
     * PackageController constructor.
     * 
     * @param PackageContract $packageRepository
     */
    public function __construct(PackageContract $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->packageRepository->listPackages();
        $this->setPageTitle('Package', 'List of all package');
        return view('admin.package.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Package', 'Create package');
        return view('admin.package.create');
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
            'price' =>  'required',
        ]);

        $params = $request->except('_token');

        $data = $this->packageRepository->createPackage($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating package.', 'error', true, true);
        }
        return $this->responseRedirect('admin.package.index', 'Package has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->packageRepository->findPackageById($id);

        $this->setPageTitle('Package', 'Edit package : ' . $data->title);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'price' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->packageRepository->updatePackage($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating package.', 'error', true, true);
        }
        return $this->responseRedirectBack('Package updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->packageRepository->deletePackage($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting package.', 'error', true, true);
        }
        return $this->responseRedirect('admin.package.index', 'Package deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->packageRepository->updateCategoryStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Category status successfully updated'));
        }
    }
}