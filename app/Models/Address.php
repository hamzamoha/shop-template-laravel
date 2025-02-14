<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'name', 'address_line_1', 'address_line_2', 'city', 'state', 'postal_code', 'country', 'phone', 'is_default'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
