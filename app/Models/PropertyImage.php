<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'sort', 'property_images'
    ];

    public function properties(){
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

}
