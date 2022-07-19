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

            $userCarts = Cart::where('user_id',  Auth::guard('user')->user()->id)->orWhere('ip', $this->ip)->get();
            // dd($userCarts);
        } else {
            $userCarts = Cart::where('ip', $this->ip)->orWhere('user_id', 0)->get();
            $address = "";

            //     // dd($userCarts);
        }
        // $data = $this->cartRepository->viewByIp();
        if (Auth::guard('user')->user()) {
            $data = Cart::where('user_id', Auth::guard('user')->user()->id)->orWhere('ip', $this->ip)->get();
        } else {
            // $data = $this->cartRepository->viewByIp();
            $data = Cart::where('ip', $this->ip)->orWhere('user_id', 0)->get();
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
            $data = Cart::where('user_id', Auth::guard('user')->user()->id)->orWhere('ip', $this->ip)->get();
            // dd($data);
        } else {
            // $data = $this->cartRepository->viewByIp();
            $data = Cart::where('ip', $this->ip)->orWhere('user_id', 0)->get();
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
            if ($ipExists) {
                // foreach($cartExists as $cartExist){
                $data = Cart::where('user_id', 0)->update([
                    'user_id' =>  Auth::guard('user')->user()->id ?? 0,

                ]);

                // }
            }

            $data = new Cart();
            $data->user_id = Auth::guard('user')->user()->id ?? 0;
            $data->ip = $this->ip;
            $data->product_id = $request->product_id;
            $data->variation_type_one = $request->variation_type_one;
            $data->price = $request->product_price;
            $data->qty = 1;
            $data->save();


            return redirect('product/cart');
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

        $validator = Validator::make($request->all(), [
            'firstname' =>  'required',
            'lname' =>  'required',
            'email' =>  'required',
            'phone' =>  'required|integer|digits:10',
            'billing_country' =>  'required',
            'billing_state' =>  'required',
        ], [
            'firstname.*' => 'First Name Required!',
            'lname.*' => 'First Name Required!',
            'billing_country.*' => 'Billing Country Required!',
            'billing_state.*' => 'Billing State Required!',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }
        try {

            $MERCHANT_KEY = "798F29SEFR";
            $SALT = "IXUNVY2IC4";
            $ENV = "prod"; // "test for test enviroment or "prod" for production enviroment

            // $dataAddressByIp = Address::where('user_id', 0)->where('ip' , $this->ip)->latest()->first();
            if (Auth::guard('user')->user()) {
            $dataAddress = Address::where('user_id', Auth::guard('user')->user()->id)->latest()->first();
                
                if ($dataAddress) {
                    Address::where('id', $dataAddress->id)->update([
                        'ip' => $this->ip,
                        'fName' => $request->firstname,
                        'lName' => $request->lname,
                        'country' => $request->billing_country,
                        'state' => $request->billing_state,
                        'phone' => $request->phone,
                        'email' => $request->email,
                    ]);
                } else {
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

                $postData = array(
                    "txnid" => "Txn_" . uniqid(),
                    "firstname" => $request->firstname,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "productinfo" => $request->productinfo,
                    "surl" => route('front.payment.success'),
                    "furl" => route('front.payment.failure'),
                    "amount" => $request->amount,
                    "state" => $request->billing_state,
                    "country" => $request->billing_country,
                    "udf1" => $request->coupon_code_id != '' ?  $request->coupon_code_id : 'notUsed',
                    "udf2" => $request->coupon_code != '' ?  $request->coupon_code : 'notUsed',
                );

                $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
                $data = $easebuzzObj->initiatePaymentAPI($postData);
                if ($data) {
                    return $data;
                }
            }else{
            
                    $data = new Address;
                    $data->user_id = 0;
                    $data->ip = $this->ip;
                    $data->fName =  $request->firstname;
                    $data->lName = $request->lname;
                    $data->country = $request->billing_state;
                    $data->state = $request->billing_state;
                    $data->phone = $request->phone;
                    $data->email = $request->email;
                    $data->save();
                

                    $postData = array(
                        "txnid" => "Txn_" . uniqid(),
                        "firstname" => $request->firstname,
                        "email" => $request->email,
                        "phone" => $request->phone,
                        "productinfo" => $request->productinfo,
                        "surl" => route('front.payment.success'),
                        "furl" => route('front.payment.failure'),
                        "amount" => $request->amount,
                        "state" => $request->billing_state,
                        "country" => $request->billing_country,
                        "udf1" => $request->coupon_code_id != '' ?  $request->coupon_code_id : 'notUsed',
                        "udf2" => $request->coupon_code != '' ?  $request->coupon_code : 'notUsed',
                    );

                    $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
                    $data = $easebuzzObj->initiatePaymentAPI($postData);
                    if ($data) {
                        return $data;
                    }
            }
            // return view('frontend.thankyou');
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



    public function couponCheck(Request $request)
    {
        $couponData = $this->cartRepository->couponCheck($request->code);
        return $couponData;
    }

    public function couponRemove()
    {
        return $this->cartRepository->couponRemove();
    }

    public function destroy($id)
    {
        $data = Cart::where('id', $id)->first();

        $data->delete();
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while deleting cart.', 'error', true, true);
        }
        return $this->responseRedirectBack('Cart deleted successfully', 'success', false, false);
    }

    public function paymentFailure(Request $request)
    {
        $request->session()->flash('status', 'Transaction failed!');
        return view('frontend.payment_failure', ['data' => $request->all()]);
    }

    public function paymentSuccess(Request $request)
    {
        $transaction_response_data = $request->all();
        // dd($transaction_response_data);
        // dd(Auth::guard('user')->user());
        // dd(Auth::guard('user')->user()->id);

        $dataAddress = Address::where('user_id', Auth::guard('user')->user()->id)->latest()->first();

        $cartData = Cart::where('user_id', Auth::guard('user')->user()->id)->get();

        $order_no = "FR" . mt_rand();

        $data = new Order();
        $data->user_id = Auth::guard('user')->user()->id ?? 0;
        $data->ip = $this->ip;
        $data->order_no = $order_no;
        $data->fname = $dataAddress->fName;
        $data->lname = $dataAddress->lName;
        $data->email = $dataAddress->email;
        $data->mobile = $dataAddress->phone;
        $data->billing_country = $dataAddress->country;
        $data->billing_state = $dataAddress->state;
        $data->amount = $request->amount;
        $data->save();

        $orderId = $data->id;
        $orderProducts = [];
        foreach ($cartData as $cartValue) {
            $orderProducts[] = [
                'order_id' => $orderId,
                'product_id' => $cartValue->product_id,
                'user_id' => Auth::guard('user')->user()->id ?? 0,
                'ip' => $this->ip,
                'order_no' => $order_no,
                'fname' => $dataAddress->fName,
                'lname' => $dataAddress->lName,
                'email' => $dataAddress->email,
                'mobile' => $dataAddress->phone,
                'billing_country' => $dataAddress->country,
                'billing_state' => $dataAddress->state,
                'amount' => $cartValue->price,
            ];
        }
        $orderProductsNewEntry = OrderProduct::insert($orderProducts);



        if ($transaction_response_data['udf1'] != 'notUsed') {
            CouponUsage::insert([
                'coupon_code_id' => $transaction_response_data['udf1'],
                'coupon_code' => $transaction_response_data['udf2'],
                'final_amount' => $transaction_response_data['amount'],
                'user_id' => Auth::guard('user')->user()->id,
                'order_id' => $order_no,
            ]);
        }

        Transaction::insert([
            'user_id' => Auth::guard('user')->user()->id,
            'txn_id' => $transaction_response_data['txnid'],
            'order_id' => $order_no,
            'amount' => $transaction_response_data['amount'],
            'status' => $transaction_response_data['status'],
            'name_on_card' => $transaction_response_data['name_on_card'],
            'bank_ref_num' => $transaction_response_data['bank_ref_num'],
            'net_amount_debit' => $transaction_response_data['net_amount_debit'],
            'payment_source' => $transaction_response_data['payment_source'],
            'issuing_bank' => $transaction_response_data['issuing_bank'],
            'cardCategory' => $transaction_response_data['cardCategory'],
            'payment_id' => $transaction_response_data['easepayid'],
            'cardnum' => $transaction_response_data['cardnum'],
            'PG_TYPE' => $transaction_response_data['PG_TYPE'],
            'card_type' => $transaction_response_data['card_type'],
            'upi_va' => $transaction_response_data['upi_va'],
            'productinfo' => $transaction_response_data['productinfo'],
            'bank_name' => $transaction_response_data['bank_name'],
            'mode' => $transaction_response_data['mode'],
            'bankcode' => $transaction_response_data['bankcode'],
            'name_on_card' => $transaction_response_data['name_on_card'],
            'addedon' => $transaction_response_data['addedon'],
        ]);

        Cart::where('user_id', Auth::guard('user')->user()->id)->destroy();
        return view('frontend.thankyou', ['data' => $request->all()]);
    }
}