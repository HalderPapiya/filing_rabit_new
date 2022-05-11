<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProduct()
    {
        return $this->hasMany('App\Models\Order', 'order_id', 'id');
    }
}