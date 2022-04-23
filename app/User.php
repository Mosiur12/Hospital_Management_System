<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'user_type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*public function courses()
    {
        return $this->hasMany(Course::class);
    }*/
    public function course()
    {
        return $this->hasMany('App\Course');
    }

    public function enrolles()
    {
        return $this->hasMany('App\Enroll');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    /*public function courses()
    {
        return $this->hasMany('App\Course'); //make sure your images table has user_id column
    }*/
}
