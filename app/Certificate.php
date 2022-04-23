<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class, "course_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "student_id");
    }
}
