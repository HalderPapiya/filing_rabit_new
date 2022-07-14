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
        // dd($request->all());

        $this->validate($request, [
            'first_name' =>  'required',
            'last_name' =>  'required',
            'country' =>  'required',
            'street' =>  'required',
            'mobile' =>  'required|integer|digits:10',
            'house_no' =>  'required',
            'state' =>  'required',
            'company_name' =>  'required',
            'city' =>  'required',
            'pin_code' =>  'required',
            'email' =>  'required',
        ], [
            'pin_code.*' => 'Pin Code Required!',
            'first_name.*' => 'First Name Required!',
            'last_name.*' => 'Last Name Required!',
        ]);
        $address = Address::where('user_id',  Auth::guard('user')->user()->id)->first();
        // dd($address);
        if (!$address) {
            $params = $request->except('_token');
            $data = $this->addressRepository->createAddress($params);
            // dd($data);
            if (!$data) {
                return $this->responseRedirectBack('Error occurred while creating Address.', 'error', true, true);
            }
            return back()->with('Success', 'Address added successFully');
            // return redirect('user/address');
        }else{
            Address::where('id', $address->id)->update([
                'fName' => $request->first_name,
                'lName' => $request->last_name,
                'company_name' => $request->company_name,
                'country' => $request->country,
                'street' => $request->street,
                'house_no' => $request->house_no,
                'state' => $request->state,
                'city' => $request->city,
                'pin' => $request->pin_code,
                'phone' => $request->mobile,
                'email' => $request->email,
            ]);
            return back()->with('Success', 'Address updated successFully');
        // return redirect()->back()->with('success', 'Account Details successfully updated');
            
        }
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