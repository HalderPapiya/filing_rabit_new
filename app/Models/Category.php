<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'title', 'description', 'image', 'link', 'status'
    ];
    public function subCategory()
    {
    	return $this->hasMany('App\Models\SubCategory','category_id','id');
    }
}
