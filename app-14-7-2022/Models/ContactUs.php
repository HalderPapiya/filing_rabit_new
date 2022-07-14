<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes;

    protected $table = 'contact_us';

    protected $fillable = [
        'title',
        'banner',
        'image',
        'email',
        'address',
        'sales_phone',
        'support_phone',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'pinterest_link',
        'youtube_link',
        'status'
    ];
}