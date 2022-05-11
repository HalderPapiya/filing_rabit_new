<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Event;
use App\Models\Forum;
use App\Models\Interest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (object)[];
        // if()
        $user = Address::where('user_id',  Auth::guard('user')->user()->id)->first();
        // dd($user);
        return view('user.dashboard', compact('data', 'user'));
    }
}