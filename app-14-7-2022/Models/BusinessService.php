<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessService extends Model
{
    protected $table = 'business_services';

    protected $fillable = [
        'user_id', 'type_id', 'name', 'valuation', 'description', 'status' 
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\User', 'type_id', 'id');
    }
    public function businessType()
    {
        return $this->belongsTo('App\Models\BusinessType', 'type_id', 'id');
    }
    public function businesses()
    {
        return $this->hasMany('App\Models\BusinessService', 'business_id', 'id');
    }
    
}