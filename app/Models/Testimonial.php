<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonial',
        'user_id'
    ];
    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
