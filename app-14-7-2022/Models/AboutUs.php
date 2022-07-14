<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model
{
    use SoftDeletes;

    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'description',
        'image1',
        'image2',
        'status'
    ];
}