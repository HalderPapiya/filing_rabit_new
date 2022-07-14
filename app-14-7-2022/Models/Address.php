<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    // use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'ip',
        'fName',
        'lName',
        'company_name',
        'country',
        'street',
        'house_no',
        'lat',
        'lng',
        'state',
        'city',
        'pin',
        'phone',
        'email'
    ];
    public function userDetails()
    {
        return $this->belongsTo('App\Models\Address', 'user_id', 'id');
    }
}