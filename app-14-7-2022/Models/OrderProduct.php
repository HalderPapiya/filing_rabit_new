<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function orderDetails()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
    public function productDetails()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}