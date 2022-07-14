<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhyUs extends Model
{
    use SoftDeletes;

    protected $table = 'why_us';

    protected $fillable = [
        'title', 'description', 'image', 'status'
    ];
}