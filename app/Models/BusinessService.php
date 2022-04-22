<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessService extends Model
{
    use SoftDeletes;
    
    protected $table = 'business_service';

    protected $fillable = [
        'user_id', 'category_id', 'sub_category_id', 'title', 'package_id', 'description', 'image', 'status' 
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }
}
