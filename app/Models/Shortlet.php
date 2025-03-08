<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlet extends Model
{
    protected $fillable = [
        'title',
        'price',
        'location',
        'fees',
        'total',

        'link',
        'images',

        'uniqId',
        'description',
        'status',
        'features'
    ];
}
