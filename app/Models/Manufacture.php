<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Manufacture extends Model
{

    use HasFactory;
    use HasSlug;

    public $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'city_id',
        'website',
        'street',
        'building',
        'postal_code'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
