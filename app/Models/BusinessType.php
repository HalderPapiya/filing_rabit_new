<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    protected $table = 'business_types';

    protected $fillable = [
        'name', 'status' 
    ];
    public function busnissService()
    {
    	return $this->hasMany('App\Models\BusnissService','type_id','id');
    }
}
