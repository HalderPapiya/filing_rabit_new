<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAddOn extends Model
{

    public function business()
    {
        return $this->belongsTo('App\Models\BusinessService', 'business_id', 'id');
    }
    public function addOn()
    {
        return $this->belongsTo('App\Models\AddOn', 'add_on_id', 'id');
    }
}