<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = ['name', 'description'];

    /**
     * A category can have many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, "parent_id");
    }
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, "parent_id");
    }
}
