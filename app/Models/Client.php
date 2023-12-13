<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agency_name',
        'agency_address',
        'office_no',
    ];
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
