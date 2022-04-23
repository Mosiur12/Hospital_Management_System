<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable=['questions_id','option'];

    public function quizes()
    {
        return $this->belongsTo(McqQuiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'questions_id');
    }
}
