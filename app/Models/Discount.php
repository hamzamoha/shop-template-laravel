<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'type', // 'flat' or 'percentage'
        'value',
        'code',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Check if the discount is currently active.
     */
    public function isActive()
    {
        $now = now();
        return (!$this->starts_at || $this->starts_at <= $now) &&
            (!$this->ends_at || $this->ends_at >= $now);
    }

    public function getIsActiveAttribute()
    {
        return $this->isActive(); // Use the existing isActive() method
    }

    /**
     * Define many-to-many relationship with Product.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_product');
    }
}
