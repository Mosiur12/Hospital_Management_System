<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'short_desc', 'course_details', 'category', 'image', 'course_fee', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enroles()
    {
        return $this->belongsToMany('App\Enroll');
    }





}
