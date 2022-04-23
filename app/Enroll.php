<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $fillable= ['student_id' ,'course_id'];

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

}
