<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    protected $fillable = [
        'region_id',
        'method',
        'cost',
    ];

    /**
     * Define the relationship with the Region model.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

