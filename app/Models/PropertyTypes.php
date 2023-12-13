<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'prop_type'
    ];

    public function property(){
        return $this->hasMany(Property::class);
    }
}
