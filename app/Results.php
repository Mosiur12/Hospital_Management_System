<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $fillable=['user_id','quiz_id','total_mark','yes_ans','no_ans','date'];
}
