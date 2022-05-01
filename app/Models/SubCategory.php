<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id', 'title', 'description', 'image', 'link', 'status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function product()
    {
    	return $this->hasMany('App\Models\Product','subCategory_id','id');
    }
    
}
