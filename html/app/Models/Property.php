<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $casts = [
        'geo' => 'array',
        'photos' => 'array',
        'for_sale' => 'boolean',
        'for_rent' => 'boolean',
        'sold' => 'boolean',
    ];

    protected $fillable = [
        'title', 'description', 'for_sale', 'for_rent', 'sold',
        'price', 'currency', 'currency_symbol', 'property_type',
        'bedrooms', 'bathrooms', 'area', 'area_type', 'geo', 'photos',
    ];
}
