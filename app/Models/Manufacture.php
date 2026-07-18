<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    public $fillable = [
        'name',
        'slug',
        'description',
        'email',
        'phone',
        'city_id',
        'website',
        'street',
        'building',
        'postal_code'
    ];
}
