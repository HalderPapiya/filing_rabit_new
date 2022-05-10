<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CouponContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    /**
     * @var CouponContract
     */
    protected $addressRepository;

    /**
     * CouponController constructor.
     * 
     * @param CouponContract $addressRepository
     */
    public function __construct(CouponContract $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->addressRepository->listCoupons();
        // dd($datas);
        $this->setPageTitle('Coupon', 'List of all Coupon');
        return view('admin.coupon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Coupon', 'Create Coupon');
        return view('admin.coupon.create');
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
        ]);

        $params = $request->except('_token');

        $data = $this->addressRepository->createCoupon($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while creating Coupon.', 'error', true, true);
        }
        return $this->responseRedirect('admin.coupon.index', 'Coupon has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->addressRepository->findCouponById($id);

        $this->setPageTitle('Coupon', 'Edit Coupon : ' . $data->title);
        return view('admin.coupon.edit', compact('data'));
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
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->addressRepository->updateCoupon($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Coupon.', 'error', true, true);
        }
        return $this->responseRedirectBack('Coupon updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->addressRepository->deleteCoupon($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting Coupon.', 'error', true, true);
        }
        return $this->responseRedirect('admin.coupon.index', 'Coupon deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->addressRepository->updateCouponStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Coupon status successfully updated'));
        }
    }
}