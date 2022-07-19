<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'productinfo', 'id');
    }
}