<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Contracts\CartContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{
    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

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
    public function couponCheck(Request $request)
    {
        $couponData = $this->cartRepository->couponCheck($request->code);
        return $couponData;
    }

    public function couponRemove(Request $request)
    {
        $couponData = $this->cartRepository->couponRemove();
        return $couponData;
    }

    public function addCart(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //     "product_id" => "required|string|max:255",
        //     "product_name" => "required|string|max:255",
        //     "product_style_no" => "required|string|max:255",
        //     "product_image" => "required|string|max:255",
        //     "product_slug" => "required|string|max:255",
        //     "product_variation_id" => "nullable|integer",
        //     "price" => "required|string",
        //     "offer_price" => "required|string",
        //     "qty" => "required|integer",
        // ]);

        $params = $request->except('_token');

        $cartStore = $this->cartRepository->addToCart($params);

        if ($cartStore) {
            return $this->responseRedirect('product.cart', 'Add to Cart Successfully', 'success', false, false);
            // return redirect()->back()->with('success', 'Product added to cart');
        } else {
            return redirect()->back()->with('failure', 'Something happened');
        }
    }

    public function viewByIp(Request $request)
    {
        $data = $this->cartRepository->viewByIp();

        if ($data) {
            return view('front.cart.index', compact('data'));
        } else {
            return view('front.404');
        }
    }

    public function delete(Request $request, $id)
    {
        $data = $this->cartRepository->delete($id);

        if ($data) {
            return redirect()->route('front.cart.index')->with('success', 'Product removed from cart');
        } else {
            return redirect()->route('front.cart.index')->with('failure', 'Something happened');
        }
    }

    public function qtyUpdate(Request $request, $id, $type)
    {
        $data = $this->cartRepository->qtyUpdate($id, $type);

        if ($data) {
            return redirect()->route('front.cart.index')->with('success', $data);
        } else {
            return redirect()->route('front.cart.index')->with('failure', 'Something happened');
        }
    }
}