<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'category_id', 'subCategory_id', 'name', 'image', 'type_one_name', 'type_two_name', 'type_one_description',
        'type_two_description', 'type_one_price', 'type_two_price', 'status'
    ];
    public function categoryDetails()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function subCategoryDetails()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subCategory_id', 'id');
    }
    // public function subCategory()
    // {
    //     return $this->belongsTo('App\Models\SubCategory', 'subCategory_id', 'id');
    // }
    public function productDescription()
    {
        return $this->hasMany('App\Models\Description', 'product_id', 'id');
    }
}