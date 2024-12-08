<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Define the relationship with the ShippingRate model.
     */
    public function shippingRates()
    {
        return $this->hasMany(ShippingRate::class);
    }
}