<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use SoftDeletes;

    protected $table = 'descriptions';

    protected $fillable = [
        'product_id', 'description', 'status'
    ];
    public function productDetails()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}