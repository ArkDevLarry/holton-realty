<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";
    protected $fillable = [
        'title',
        'size',
        'slug',
        'price',
        'location',
        'loctext',

        'document',
        'status',

        'sold',
        'type',
        'link',

        'description',
        'uniqId',
        'images',
        'features',
    ];
}
