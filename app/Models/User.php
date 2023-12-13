<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commenter;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'mobile',
        'address',
        'avatar',
        'email',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add a mutator to ensure hashed passwords
     */


    public function clients(){
        return $this->hasOne(Client::class);
    }
    public function properties(){
        return $this->hasMany(Property::class);
    }

    public function favorite_props(){
        return $this->belongsToMany(Property::class, 'favorite_prop')->withTimestamps();
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
    public function roles(){
        return $this->belongsTo(Role::class,'role_id','id');
    }
    public function testimonials(){
        return $this->hasMany(Testimonial::class);
    }
}
