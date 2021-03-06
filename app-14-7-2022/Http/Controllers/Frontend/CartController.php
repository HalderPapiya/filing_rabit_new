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
use App\Helper\Easebuzz;
use Illuminate\Support\Facades\Validator;

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
            $address = Address::where('user_id',  Auth::guard('user')->user()->id)->latest()->first();

            $userCarts = Cart::where('user_id',  Auth::guard('user')->user()->id)->get();
            // dd($userCarts);
        } else {
            $userCarts = Cart::where('ip', $this->ip)->where('user_id', 0)->get();
            $address = Address::where('ip', $this->ip)->latest()->where('user_id', 0)->latest()->first();

            //     // dd($userCarts);
        }
        // $data = $this->cartRepository->viewByIp();
        if (Auth::guard('user')->user()) {
            $data = Cart::where('user_id', Auth::guard('user')->user()->id)->orWhere('user_id', 0)->get();
        } else {
            // $data = $this->cartRepository->viewByIp();
            $data = Cart::where('ip', $this->ip)->where('user_id', 0)->get();
        }

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
        if (Auth::guard('user')->user()) {
            $data = Cart::where('user_id', Auth::guard('user')->user()->id)->orWhere('user_id', 0)->get();
            // dd($data);
        } else {
            // $data = $this->cartRepository->viewByIp();
            $data = Cart::where('ip', $this->ip)->where('user_id', 0)->get();
        }
        // dd($data);
        // $data = $this->cartRepository->viewByIp();

        if ($data) {
            return view('frontend.cart', compact('data'));
        } else {
            return view('front.404');
        }

        // return view('frontend.cart');
    }

    function easebuzz_gateway()
    {
        return View('frontend.thanktou');
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
        // dd($request->all());
        $cartExists = Cart::where('product_id', $request->product_id)->where('ip', $this->ip)->first();
        $ipExists = Cart::where('user_id', 0)->where('ip', $this->ip)->get();
        // dd($ipExists);
        if (!$cartExists) {
            // dd('here');
            if($ipExists){
                // foreach($cartExists as $cartExist){
                $data= Cart::where('user_id', 0)->update([
                                'user_id'=>  Auth::guard('user')->user()->id ?? 0,
                                
                            ]);
                    
                        // }
            }
            // if (Auth::guard('user')->user()) {
                $data = new Cart();
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->product_id = $request->product_id;
                $data->variation_type_one = $request->variation_type_one;
                $data->price = $request->product_price;
                $data->qty = 1;
                $data->save();
            // } else {
            //     $data = new Cart();
            //     $data->ip = $this->ip;
            //     $data->user_id = Auth::guard('user')->user()->id ?? 0;
            //     $data->product_id = $request->product_id;
            //     $data->variation_type_one = $request->variation_type_one;
            //     $data->price = $request->product_price;
            //     $data->qty = 1;
            //     $data->save();
            // }
            // dd('test');

            // return $this->responseRedirect('product.cart', 'Successfully, added to cart!', 'success', false, false);
            return redirect('product/cart');
            // return redirect()->route('product.cart')->with('success', 'Add to Cart Successfully');
        }
        return redirect('product/cart');
        // return $this->responseRedirect('product.cart', 'Product already exist in cart', 'success', false, false);
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
        // die;
        // 
        // $this->validate($request, [
        //     'fname' =>  'required',
        //     'lname' =>  'required',
        //     'email' =>  'required',
        //     'mobile' =>  'required|integer|digits:10',
        //     'billing_country' =>  'required',
        //     'billing_state' =>  'required',
        //     // 'mobile' =>  'required',
        // ], [
        //     'fname.*' => 'First Name Required!',
        //     'lname.*' => 'First Name Required!',
        //     'billing_country.*' => 'Billing Country Required!',
        //     'billing_state.*' => 'Billing State Required!',
        // ]);

        try {
            $validator = Validator::make($request->all(), [
                'firstname' =>  'required',
                'lname' =>  'required',
                'email' =>  'required',
                'phone' =>  'required|integer|digits:10',
                'billing_country' =>  'required',
                'billing_state' =>  'required',
                // 'mobile' =>  'required',
            ], [
                'firstname.*' => 'First Name Required!',
                'lname.*' => 'First Name Required!',
                'billing_country.*' => 'Billing Country Required!',
                'billing_state.*' => 'Billing State Required!',
            ]);
            if ($validator->fails()) {
                return response()->json([ 'status' => false, 'message' => $validator->errors()->first()], 200);
            }
            $MERCHANT_KEY = "798F29SEFR";
            $SALT = "IXUNVY2IC4";
            $ENV = "prod"; // "test for test enviroment or "prod" for production enviroment

            // dd($request->all());
            $order_no = "FR" . mt_rand();

            // if user is logged in
            if (Auth::guard('user')->user()) {
                // dd($request->all());
                $data = new Order();
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->order_no = $order_no;
                $data->fname = $request->firstname;
                $data->lname = $request->lname;
                $data->email = $request->email;
                $data->mobile = $request->phone;
                $data->billing_country = $request->billing_country;
                $data->billing_state = $request->billing_state;
                $data->amount = $request->amount;
                $data->payment_method = $request->payment_method;
                $data->save();

                $address = Address::where('user_id', Auth::guard('user')->user()->id)->first();
                // dd($address);
                // if($address!="")
                // {
                //    Address::where('user_id',Auth::guard('user')->user())->update([
                //             'ip'=> $this->ip,
                //             'fName'=>$request->fname,
                //             'lName'=>$request->lName,
                //             'country'=>$request->country,
                //             'state'=>$request->state,
                //             'phone'=>$request->phone,
                //             'email'=> $request->email,
                //         ]);

                // }else{

                $data = new Address;
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->fName =  $request->fname;
                $data->lName = $request->lname;
                $data->country = $request->billing_country;
                $data->state = $request->billing_state;
                $data->phone = $request->phone;
                $data->email = $request->email;
                $data->save();
                // }


                $orderId = $data->id;

                $cartData = Cart::where('ip', $this->ip)->get();
                // if()
                // 2 insert cart data into order products
                $orderProducts = [];
                foreach ($cartData as $cartValue) {
                    $orderProducts[] = [
                        'order_id' => $orderId,
                        'product_id' => $cartValue->product_id,
                        'user_id' => Auth::guard('user')->user()->id ?? 0,
                        'ip' => $this->ip,
                        'order_no' => $order_no,
                        'fname' => $request->firstname,
                        'lname' => $request->lname,
                        'email' => $request->email,
                        'mobile' => $request->phone,
                        'billing_country' => $request->billing_country,
                        'billing_state' => $request->billing_state,
                        'amount' => $cartValue->price,
                    ];
                }
                $orderProductsNewEntry = OrderProduct::insert($orderProducts);
                $dataAddress= Address::where('user_id',Auth::guard('user')->user()->id)->latest()->first();
                // dd($dataAddress);
                if($dataAddress){
                    Address::where('id',$dataAddress->id)->update([
                                    'ip'=> $this->ip,
                                    'fName'=>$request->firstname,
                                    'lName'=>$request->lname,
                                    'country'=>$request->billing_country,
                                    'state'=>$request->billing_state,
                                    'phone'=>$request->phone,
                                    'email'=> $request->email,
                                ]);
                }else{
                    $data = new Address;
                    $data->user_id = Auth::guard('user')->user()->id ?? 0;
                    $data->ip = $this->ip;
                    $data->fName =  $request->firstname;
                    $data->lName = $request->lname;
                    $data->country = $request->billing_state;
                    $data->state = $request->billing_state;
                    $data->phone = $request->phone;
                    $data->email = $request->email;
                    $data->save();
                
                
                }
                // cart delete
                // $emptyCart = Cart::where('user_id', Auth::guard('user')->user()->id)->delete();

                $postData = array(
                    "txnid" => "TEST" . uniqid(),
                    "firstname" => $request->firstname,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "productinfo" => "Laptop",
                    "surl" => url('product/easebuzz-webhook'),
                    "furl" => url('product/easebuzz-webhook'),
                    "amount" => $request->amount . '.00',
                    "udf1" => "aaaa",
                    "udf2" => "aaaa",
                    "udf3" => "aaaa",
                    "udf4" => "aaaa",
                    "udf5" => "aaaa",
                    "udf6" => "aaaa",
                    "udf7" => "aaaa",
                    "address1" => "aaaa",
                    "address2" => "aaaa",
                    "city" => "aaaa",
                    "state" => "aaaa",
                    "country" => "aaaa",
                    "zipcode" => "123123",
                );


                if ($request->coupon_code_id != '') {
                    CouponUsage::insert([
                        'coupon_code_id' => $request->coupon_code_id,
                        'coupon_code' => $request->coupon_code,
                        'discount' => $request->discount,
                        'total_checkout_amount' => $request->total_checkout_amount,
                        'final_amount' => $request->amount,
                        'user_id' => Auth::guard('user')->user()->id ?? 0,
                        'user_ip' => $this->ip,
                    ]);
                }

                // dd($postData);

                $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
                return $easebuzzObj->initiatePaymentAPI($postData);
            } else {
                $data = new Order();
                $data->user_id = Auth::guard('user')->user()->id ?? 0;
                $data->ip = $this->ip;
                $data->order_no = $order_no;
                // $data->product_id = $request->product_id;
                $data->fname = $request->fname;
                $data->lname = $request->lname;
                $data->email = $request->email;
                $data->mobile = $request->phone;
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
                $data->country = $request->billing_country;
                $data->state = $request->billing_state;
                $data->phone = $request->phone;
                $data->email = $request->email;
                $data->save();


                $cartData = Cart::where('ip', $this->ip)->get();
                // if()
                // 2 insert cart data into order products
                $orderProducts = [];
                foreach ($cartData as $cartValue) {
                    $orderProducts[] = [
                        'order_id' => $orderId,
                        'product_id' => $cartValue->product_id,
                        'user_id' => Auth::guard('user')->user()->id ?? 0,
                        'ip' => $this->ip,
                        'order_no' => $order_no,
                        'fname' => $request->fname,
                        'lname' => $request->lname,
                        'email' => $request->email,
                        'mobile' => $request->phone,
                        'billing_country' => $request->billing_country,
                        'billing_state' => $request->billing_state,
                        'amount' => $cartValue->price,
                    ];
                }
                $orderProductsNewEntry = OrderProduct::insert($orderProducts);
                $postData = array(
                    "txnid" => "TEST" . uniqid(),
                    "firstname" => $request->firstname,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "productinfo" => "Laptop",
                    "surl" => url('product/easebuzz-webhook'),
                    "furl" => url('product/easebuzz-webhook'),
                    "amount" => $request->amount . '.00',
                    "udf1" => "aaaa",
                    "udf2" => "aaaa",
                    "udf3" => "aaaa",
                    "udf4" => "aaaa",
                    "udf5" => "aaaa",
                    "udf6" => "aaaa",
                    "udf7" => "aaaa",
                    "address1" => "aaaa",
                    "address2" => "aaaa",
                    "city" => "aaaa",
                    "state" => "aaaa",
                    "country" => "aaaa",
                    "zipcode" => "123123",
                );
                if ($request->coupon_code_id != '') {
                    CouponUsage::insert([
                        'coupon_code_id' => $request->coupon_code_id,
                        'coupon_code' => $request->coupon_code,
                        'discount' => $request->discount,
                        'total_checkout_amount' => $request->total_checkout_amount,
                        'final_amount' => $request->amount,
                        'user_id' => Auth::guard('user')->user()->id ?? 0,
                        'user_ip' => $this->ip,
                    ]);
                }



                // dd($postData);

                $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
                return $easebuzzObj->initiatePaymentAPI($postData);
            }
            // $emptyCart = Cart::where('ip', $this->ip)->delete();
            // return view('easebuzz_gateway');
            return view('frontend.thankyou');

            // return redirect()->back()->with('message', 'Order successful');
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
    function easebuzz_webhook(Request $request)
    {
        dd("here");
        $easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $this->SALT, $ENV = null);
        $result = $easebuzzObj->easebuzzResponse($request->all());
        dd($result);
        $res = json_decode($result);
        $status = $res->status;
        if ($status == 1) {
            $data = $res->data;
            $orderId = $data->txnid;
            $status = $data->status;
            if ($status == 'success') {
                // here your update query
                Order::where('id', $orderId)->update(['status_id' => 1]);
                \Session::flash('successMessage', 'Successful..!');
                return redirect('product/easebuzz-gateway');
            } else {
                \Session::flash('errorMessage', 'failed!');
                return redirect('agent/add-money/v1/welcome');
            }
        }
    }
    public function initiatePaymentLink(Request $request)
    {
        $MERCHANT_KEY = "798F29SEFR";
        $SALT = "IXUNVY2IC4";
        $ENV = "prod"; // "test for test enviroment or "prod" for production enviroment


        $postData = array(
            "txnid" => "TEST" . uniqid(),
            "firstname" => $request->firstname,
            "email" => $request->email,
            "phone" => $request->phone,
            "productinfo" => "Laptop",
            "surl" => "http://127.0.0.1:8000/product/cart",
            "furl" => "http://127.0.0.1:8000/product/cart",
            "amount" => $request->amount . '.00',
            "udf1" => "aaaa",
            "udf2" => "aaaa",
            "udf3" => "aaaa",
            "udf4" => "aaaa",
            "udf5" => "aaaa",
            "udf6" => "aaaa",
            "udf7" => "aaaa",
            "address1" => "aaaa",
            "address2" => "aaaa",
            "city" => "aaaa",
            "state" => "aaaa",
            "country" => "aaaa",
            "zipcode" => "123123",
        );

        // dd($postData);

        $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
        return $easebuzzObj->initiatePaymentAPI($postData);
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

    public function couponRemove()
    {
        return $this->cartRepository->couponRemove();
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
        $data = Cart::where('id', $id)->first();
        // dd($data);
        // ->delete();
        // $data = Cart::findOrFail($id);
        $data->delete();
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting cart.', 'error', true, true);
        }
        return $this->responseRedirectBack('Cart deleted successfully', 'success', false, false);
    }
}