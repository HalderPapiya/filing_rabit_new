<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function business()
    {
        return $this->belongsTo('App\Models\BusinessService', 'business_id', 'id');
    }
}