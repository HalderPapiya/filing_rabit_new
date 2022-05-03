<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultant extends Model
{
    use SoftDeletes;

    protected $table = 'consultants';

    protected $fillable = [
        'name', 'email', 'phone', 'city', 'message', 'status'
    ];
}