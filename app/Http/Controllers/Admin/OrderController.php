<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::get();
        // forea
        // $product= OrderProduct::where('order_id' , $data->id)->get();
        // dd($product);
        $this->setPageTitle('Order', 'List of All Order');
        return view('admin.order.index', compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::where('id',$id)->findOrFail($id);
        // dd($orders);
        // foreach ($orders as $key => $order) {
        $data= OrderProduct::where('order_id' , $orders->id)->get();
        // dd($orderProducts);
        $this->setPageTitle('Order', 'List of All Order');
        return view('admin.order.show', compact('data','orders'));
    }
    public function status($id, $status)
    {
        $updatedEntry = Order::findOrFail($id);
        $updatedEntry->status = $status;
        $updatedEntry->save();

        // return $updatedEntry;

        if ($updatedEntry) {
            return redirect()->back();
        } else {
            return redirect()->route('admin.order.index');
        }
    }
    
}