<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\BaseController;
use App\Models\Cart;
use App\Models\Description;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }
    // public function __construct() {

    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::where('id', Auth::guard('user')->user()->id)->first();
        // dd($users);
        // $user_id =;
        if (Auth::guard('user')->user()) {
            $userCarts = Cart::where('user_id',  Auth::guard('user')->user()->id)->get();
            // dd($userCarts);
        } else {
            $userCarts = Cart::where('ip', $this->ip)->get();
            //     // dd($userCarts);
        }
        return view('frontend.checkout', compact('userCarts'));
    }
    public function userGet()
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showCart($id)
    {
        $data = Cart::findOrFail($id);
    }
    public function product($id)
    {
    }
    public function productDescription()
    {
    }

    /**
     * Show the form for creating a new resource for add cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        $cartExists = Cart::where('product_id', $request->product_id)->where('ip', $this->ip)->first();
        if (!$cartExists) {
            if (Auth::guard('user')->user()) {
                $data = new Cart();
                $data->user_id = Auth::guard('user')->user()->id;
                $data->ip = $this->ip;
                $data->product_id = $request->product_id;
                $data->variation_type_one = $request->variation_type_one;
                $data->price_one = $request->product_price;
                $data->qty = 1;
                $data->save();
            } else {
                $data = new Cart();
                $data->ip = $this->ip;
                $data->user_id = 0;
                $data->product_id = $request->product_id;
                $data->variation_type_one = $request->variation_type_one;
                $data->price_one = $request->product_price;
                $data->qty = 1;
                $data->save();
            }
            return $this->responseRedirect('product.cart', 'Add to Cart Successfully', 'success', false, false);
        }

        return $this->responseRedirect('product.cart', 'Already Exist This Product', 'success', false, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Order(Request $request)
    {
        // dd($request->all());
        $order_no = "FR" . mt_rand();
        // if (Auth::guard('user')->user()) {
        $data = new Order();
        $data->user_id = Auth::guard('user')->user()->id ?? 0;
        $data->ip = $this->ip;
        $data->order_no = $order_no;
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->billing_country = $request->billing_country;
        $data->billing_state = $request->billing_state;
        $data->amount = $request->amount;
        // $data->qty = 1;
        $data->save();


        $cartData = Cart::where('ip', $this->ip)->get();

        // 2 insert cart data into order products
        $orderProducts = [];
        foreach ($cartData as $cartValue) {
            $orderProducts[] = [
                // 'order_id' => $data->id,
                'product_id' => $data->product_id,
                'user_id' => Auth::guard('user')->user()->id ?? 0,
                'ip' => $this->ip,
                'order_no' => $order_no,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'billing_country' => $request->billing_country,
                'billing_state' => $request->billing_state,
                'amount' => $request->amount,



            ];
        }
        $orderProductsNewEntry = OrderProduct::insert($orderProducts);

        return view('frontend.cart', compact('cartData'));
        // $cartData = $this->checkoutRepository->viewCart();
        // if (Auth::guard('user')->user()) {
        //     // $addressData = $this->checkoutRepository->addressData();
        //     $addressData = User::first();
        // } else {
        //     $addressData = null;
        // }

        // if ($cartData) {
        //     return view('front.checkout.index', compact('cartData', 'addressData'));
        // } else {
        //     return redirect()->route('front.cart.index');
        // }
    }

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