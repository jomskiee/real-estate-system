<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    public function user_report(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function properties(){
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
