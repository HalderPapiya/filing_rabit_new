<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\AddressContract;
use App\Http\Controllers\BaseController;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends BaseController
{
    /**
     * @var AddressContract
     */
    protected $addressRepository;

    /**
     * ContactUsController constructor.
     * 
     * @param AddressContract $addressRepository
     */
    public function __construct(AddressContract $addressRepository)
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->addressRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::get();
        $ip = Address::where('ip', $this->ip)->First();
        // dd($address->userDetails);
        if (Auth::guard('user')->user()) {
            $address = Address::where('user_id',  Auth::guard('user')->user()->id)->first();
            return view('user.address', compact('address'));
        }
        // else {
        //     return view('user.address_update');
        // }
        // else {
        //     $address = Address::where('ip', $this->ip)->first();
        // }
        // dd($address);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $this->setPageTitle('Address', 'Create Address');
    //     return view('admin.about_us.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'title' =>  'required',
        // ]);
        $address = Address::where('user_id',  Auth::guard('user')->user()->id)->first();
        // dd($address);
        $params = $request->except('_token');
        if (!$address) {
            $data = $this->addressRepository->createAddress($params);
            if (!$data) {
                return $this->responseRedirectBack('Error occurred while creating Address.', 'error', true, true);
            }
            return redirect('user/address');
        }
        return $this->responseRedirectBack('Already Exist', 'success', false, false);
        // else {
        //     $data = $this->addressRepository->updateAddress($id, $params);
        //     // dd($data);
        // }


        // return $this->responseRedirect('user.address', 'Address has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->addressRepository->findAddressById($id);

        $this->setPageTitle('Address', 'Edit Address : ' . $data->title);
        return view('admin.about_us.edit', compact('data'));
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
        ]);

        $params = $request->except('_token');

        //dd($params);

        $data = $this->addressRepository->updateAddress($params);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Address.', 'error', true, true);
        }
        return $this->responseRedirectBack('Address updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->addressRepository->deleteAddress($id);

        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting Address.', 'error', true, true);
        }
        return $this->responseRedirect('admin.about-us.index', 'Address deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $data = $this->addressRepository->updateAddressStatus($params);

        if ($data) {
            return response()->json(array('message' => 'Address status successfully updated'));
        }
    }
}