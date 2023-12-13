<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravelista\Comments\Commentable;
class Property extends Model
{
    use HasFactory;
    use Sluggable;
    use Commentable;

    protected $fillable = [
        'user_id', 'proj_name', 'slug', 'status', 'publish'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'proj_name'
            ]
        ];
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function propertyDetails(){
        return $this->hasOne(PropertyDetails::class);
    }
    public function propImages(){
        return $this->hasMany(PropertyImage::class);
    }

    public function favorite_users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function prop_type(){
        return $this->belongsTo(PropertyTypes::class, 'prop_type_id', 'id');
    }
    public function rep_props(){
        return $this->hasMany(Report::class);
    }

}
