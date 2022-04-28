<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustriesServe extends Model
{
    use SoftDeletes;

    protected $table = 'industries_serves';

    protected $fillable = [
        'title', 'image', 'status'
    ];
}