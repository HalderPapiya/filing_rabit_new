<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Description;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Contracts\CartContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class CartController extends BaseController
{
    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }
    /**
     * HomeController constructor.
     */

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
            $address = Address::where('user_id',  Auth::guard('user')->user()->id)->first();

            $userCarts = Cart::where('user_id',  Auth::guard('user')->user()->id)->get();
            // dd($address);
        } else {
            $userCarts = Cart::where('ip', $this->ip)->get();
            $address = Address::where('ip', $this->ip)->First();

            //     // dd($userCarts);
        }
        $data = $this->cartRepository->viewByIp();

        if ($data) {
            return view('frontend.checkout', compact('data', 'address'));
        } else {
            return view('front.404');
        }
        return view('frontend.checkout', compact('userCarts', 'address', 'data'));
    }
    public function userGet()
    {
    }

    public function cartView()

    {
        $data = $this->cartRepository->viewByIp();

        if ($data) {
            return view('frontend.cart', compact('data'));
        } else {
            return view('front.404');
        }

        // return view('frontend.cart');
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
        // 

        try {
            // $this->validate($request, [
            //     'fname' =>  'required',
            //     'lname' =>  'required',
            //     'email' =>  'required',
            //     'mobile' =>  'required',
            //     'billing_country' =>  'required',
            //     'billing_state' =>  'required',
            //     'mobile' =>  'required',
            // ]);
            // dd($request->all());
            $order_no = "FR" . mt_rand();
            if (Auth::guard('user')->user()) {
                // dd($request->all());
                $data = new Order();
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->order_no = $order_no;
                // $data->product_id = $request->product_id;
                $data->fname = $request->fname;
                $data->lname = $request->lname;
                $data->email = $request->email;
                $data->mobile = $request->mobile;
                $data->billing_country = $request->billing_country;
                $data->billing_state = $request->billing_state;
                $data->amount = $request->amount;
                $data->payment_method = $request->payment_method;
                // $data->qty = 1;
                $data->save();

                $orderId = $data->id;


                $data = new Address;
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->fName =  $request->fname;
                $data->lName = $request->lname;
                $data->country = $request->billing_state;
                $data->state = $request->billing_state;
                $data->phone = $request->mobile;
                $data->email = $request->email;
                $data->save();


                $cartData = Cart::where('ip', $this->ip)->get();
                // if()
                // 2 insert cart data into order products
                $orderProducts = [];
                foreach ($cartData as $cartValue) {
                    $orderProducts[] = [
                        'order_id' => $orderId,
                        'product_id' => $request->product_id,
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
            } else {
                $data = new Order();
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->order_no = $order_no;
                // $data->product_id = $request->product_id;
                $data->fname = $request->fname;
                $data->lname = $request->lname;
                $data->email = $request->email;
                $data->mobile = $request->mobile;
                $data->billing_country = $request->billing_country;
                $data->billing_state = $request->billing_state;
                $data->amount = $request->amount;
                $data->payment_method = $request->payment_method;
                // $data->qty = 1;
                $data->save();
                $orderId = $data->id;


                $data = new Address;
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->fName =  $request->fname;
                $data->lName = $request->lname;
                $data->country = $request->billing_state;
                $data->state = $request->billing_state;
                $data->phone = $request->mobile;
                $data->email = $request->email;
                $data->save();


                $cartData = Cart::where('ip', $this->ip)->get();
                // if()
                // 2 insert cart data into order products
                $orderProducts = [];
                foreach ($cartData as $cartValue) {
                    $orderProducts[] = [
                        'order_id' => $orderId,
                        'product_id' => $request->product_id,
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
            }
            $emptyCart = Cart::where('ip', $this->ip)->delete();
            return redirect()->back()->with('message', 'Order successful');
            // if ($request->check) {

            // }
            // if (Auth::guard('user')->user()) {
            //     $userCarts = Order::where('user_id',  Auth::guard('user')->user()->id)->first();
            //     // dd($userCarts);
            // } else {
            //     $userCarts = Order::where('ip', $this->ip)->first();
            //     // dd($userCarts);
            // }


            // return redirect()->route('product.cart.checkout');

            // return $this->responseRedirect('product.cart.checkout', 'Product', 'success', false, false);
            // return view('frontend.cart', compact('cartData', 'userCarts'));
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
        } catch (\Exception $error) {
            throw $error;
        }
    }
    public function cartCheckout(Request $request)
    {
        if (Auth::guard('user')->user()) {
            $userCarts = Order::where('user_id',  Auth::guard('user')->user()->id)->first();
            if ($userCarts->payment_method == 'COD') {
                return view('frontend.cart', compact('userCarts'));
            } else {
                return view('frontend.payment_getway', compact('userCarts'));
            }
            // dd($userCarts);
        } else {
            $userCarts = Order::where('ip', $this->ip)->first();
            // dd($userCarts->payment_method);
            if ($userCarts->payment_method == 'COD') {
                return view('frontend.cart', compact('userCarts'));
            } else {
                return view('frontend.payment_getway', compact('userCarts'));
            }
            // dd($userCarts);
        }
    }
    public function transaction()
    {

        $emptyCart = Cart::where('ip', $this->ip)->delete();
        if (Auth::guard('user')->user()) {
            $userCarts = Order::where('user_id',  Auth::guard('user')->user()->id)->first();
            // dd($userCarts->payment_method);
            $txnData = new Transaction();
            $txnData->user_id = Auth::guard('user')->user()->id ?? 0;
            $txnData->ip = $this->ip;
            $txnData->order_id = $userCarts->id;
            $txnData->transaction = 'TXN_' . strtoupper(Str::random(20));
            // $txnData->online_payment_id = $collectedData['razorpay_payment_id'];
            $txnData->amount = $userCarts->amount;
            $txnData->currency = "INR";
            $txnData->method = "";
            $txnData->description = "";
            $txnData->bank = "";
            $txnData->upi = "";
            $txnData->save();
            // dd($userCarts);
        } else {
            $userCarts = Order::where('ip', $this->ip)->first();
            // dd($userCarts->payment_method);
            $txnData = new Transaction();
            $txnData->user_id = Auth::guard('user')->user()->id ?? 0;
            $txnData->ip = $this->ip;
            $txnData->order_id = $userCarts->id;
            $txnData->transaction = 'TXN_' . strtoupper(Str::random(20));
            // $txnData->online_payment_id = $collectedData['razorpay_payment_id'];
            $txnData->amount = $userCarts->amount;
            $txnData->currency = "INR";
            $txnData->method = "";
            $txnData->description = "";
            $txnData->bank = "";
            $txnData->upi = "";
            $txnData->save();
            // dd($userCarts);
        }
        return redirect()->back()->with('message', 'Order successful');
        // return $this->responseRedirect('product.cart.checkout', 'Order successfull', 'success', false, false);
    }


    public function couponCheck(Request $request)
    {
        $couponData = $this->cartRepository->couponCheck($request->code);
        return $couponData;
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