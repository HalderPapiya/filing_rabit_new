<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contracts\SubCategoryContract;
use App\Contracts\CategoryContract;
use App\Contracts\BlogContract;
use App\Models\User;
use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends BaseController
{

    /**
     * HomeController constructor.
     * 
     * @param SubCategoryContract $subCategoryRepository
     * @param CategoryContract $categoryRepository
     * @param BlogContract $blogRepository
     */
    public function __construct(SubCategoryContract $subCategoryRepository, CategoryContract $categoryRepository,  BlogContract $blogRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->blogRepository = $blogRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.dashboard');
    }
    public function order()
    {
        $orders = OrderProduct::where('user_id', Auth::guard('user')->user()->id)->get();
        // dd($orders);
        return view('user.order', compact('orders'));
    }

    public function download()
    {
        return view('user.download');
    }
    public function address()
    {
        $user = User::get();
        $address = Address::where('user_id',  Auth::guard('user')->user()->id)->first();
        // dd($address->userDetails);
        return view('user.address', compact('address', 'user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $blogs = $this->blogRepository->listBlogs();


        return view('frontend.blog', compact('blogs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
        //     'short_description' =>  'required',
        //     // 'video' =>  'max:50000',
        // ]);
        // $id = Auth::user()->id;
        $data = new User;
        // $data->user_id = $id;
        $data->first_name = $request->input('first_name');
        $data->last_name = $request->input('last_name');
        $data->email = $request->input('email');
        $data->company_name = $request->input('company_name');
        $data->country = $request->input('country');
        $data->street = $request->input('street');
        $data->city = $request->input('city');
        $data->state = $request->input('state');
        $data->pin_code = $request->input('pin_code');
        $data->mobile = $request->input('mobile');
        $data->save();
        return redirect('/address')->with('success', 'Contact Added Successfully');
    }

    public function account()
    {
        // $data = User::where('id', auth()->user->id)->get();
        // $data = User::get();

        $id = Auth::guard('user')->user()->id;
        $data = User::where('id', $id)->first();
        // dd($data);
        return view('user.account_details', compact('data'));
    }
    public function accountUpdate(Request $request)
    {

        $this->validate($request, [
            'first_name' =>  'required',
            'last_name' =>  'required',
            'email' =>  'required',
            // 'video' =>  'max:50000',
        ]);
    $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'last_name' => 'required'
            
        ]);
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
       
        $user->email = $request->email;
       
        $user->save();
        return back()->with('Success', 'Profile updated successFully');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' =>  'required',
            'new_password' =>  'required',
            'confirm_password' =>  'required|same:new_password',
            // 'video' =>  'max:50000',
        ]);
        $user = Auth::guard('user')->user();
        // dd($user);
        // $user = User::first();
        $userPassword = $user->password;
        // dd($userPassword);
        if (!Hash::check($request->new_password, $userPassword)) {
            return back()->withErrors(['password' => 'password not match']);
        }
        $id = Auth::guard('user')->user()->id;
        User::find($id)->update(['password'=> Hash::make($request->new_password)]);

        // $user->password = Hash::make($request->new_password);

        // $user->save();

        return redirect()->back()->with('success', 'password successfully updated');
    }


    //     $data = new User;
    //     // User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
    //     // $data->update(['password' => Hash::make($request->new_password)]);
    //     $data->update(['password' => $request->new_password]);
    // }
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