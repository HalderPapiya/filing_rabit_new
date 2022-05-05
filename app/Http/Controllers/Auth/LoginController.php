<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware('auth:user');
        // }
        // public function __construct()
        // {
        // $this->middleware('auth')->except('logout');
    }

    // public function loginForm()
    // {
    //     return view('auth.user_login');
    // }
    public function loginForm()
    {
        return redirect()->route('home');
    }

    public function userLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required | string '
        // ]);

        // if (Auth::guard('web')->attempt(['email' => $request->user_email, 'password' => $request->password])) {
        //     return response()->json(['success' => true, 'message' => 'Login successfully'], 200);
        // }
        // // return back()->withInput($request->only('email', 'remember'))->withErrors([
        // //     'password' => 'Wrong password.',
        // // ]);
        // return response()->json(['success' => true, 'message' => 'Something wrong'], 200);


        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }


        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            // return redirect()->intended('user-dashboard')
            // ->withSuccess('Signed in');
            return response()->json(['success' => true, 'message' => 'Login successful'], 200);
        } else {
            return response()->json(['success' => false,  'message' => $validator->errors()->first()]);
        }

        // return redirect("home")->withSuccess('Login details are not valid');
    }

    public function logout(Request $request)
    {
        // dd($request->all());
        $this->guard('user')->logout();

        $request->session()->invalidate();

        return redirect()->route('home');
    }
}