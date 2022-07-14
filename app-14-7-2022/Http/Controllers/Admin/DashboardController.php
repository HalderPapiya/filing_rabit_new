<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Forum;
use App\Models\Interest;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\User;

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
        $data->users = User::latest()->get();
        $data->orders = Order::latest()->get();
        $data->products = Product::latest()->get();
        $data->categories = Category::latest()->get();
        $data->subcategories = SubCategory::latest()->get();
        return view('admin.dashboard', compact('data'));
    }
}