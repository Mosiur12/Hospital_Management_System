<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function course()
    {
        return $this->hasOne(Course::class);
    }
}
