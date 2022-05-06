<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function userCart()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function productCart()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}