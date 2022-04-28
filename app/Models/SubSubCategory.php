<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubCategory extends Model
{
    use SoftDeletes;

    protected $table = 'sub_sub_categories';

    protected $fillable = [
        'category_id', 'sub_category_id', 'title', 'status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }
    public function subCategoryDetails()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }
}