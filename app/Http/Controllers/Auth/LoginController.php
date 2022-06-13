<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Json;
use Laravel\Socialite\Facades\Socialite;

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
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $credentials = $request->only('email', 'password');

        // dd($credentials);
        // echo Auth::attempt($credentials);
        // die;

        if (Auth::guard('user')->attempt($credentials)) {
            // return redirect()->intended('user-dashboard')
            // ->withSuccess('Signed in');
            return response()->json(['success' => true, 'message' => 'Login successful', "redirect_url" => url('/')], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Credentials do not match']);
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

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        // dd('hi');
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {

            return redirect('/');
            // echo $e;
            // die;
        }
        // only allow people with @company.com to login
        // if (explode("@", $user->email)[1] !== 'company.com') {
        //     return redirect()->to('/');
        // }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        // if ($existingUser) {
        //     if (Auth::loginUsingId($existingUser->id)) {
        //         // dd(Auth::guard('user')->user());
        //         return redirect()->to('/')->with('success', 'LoggedIn');
        //     }
        // } 
        $existingUser = User::where('google_id', $user->id)->first();
// dd($existingUser);
            if($existingUser){
                // Auth::login($existingUser);
                // // dd('here');

                // return  redirect('/');
                return response()->json(['success' => true, 'message' => 'Login successful', "redirect_url" => url('/')], 200);

            }
        else {
            // create a new user
            $newUser   = new User;
            $newUser->first_name  = explode(' ', $user->name)[0];
            $newUser->last_name   = explode(' ', $user->name)[1];
            $newUser->email  = $user->email;
            $newUser->google_id  = $user->id;
            $newUser->type = 'user';
            $newUser->save();
            $existingUser = $newUser;

            if (Auth::loginUsingId($existingUser->id)) {
                return redirect()->to('/')->with('success', 'LoggedIn');
            }
        }
        return redirect()->to('/')->with('success', 'loggedIn');
    }
}