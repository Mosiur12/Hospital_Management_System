<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['mcq_quiz_id','question','answer','status','note', 'image'];

    public function optionsdata()
    {
        return $this->hasMany(Option::class)->inRandomOrder();
    }
    /*public function quizes()
    {
        return $this->belongsTo(Option::class);
    }*/
    public function options()
    {
        return $this->hasMany(Option::class, 'questions_id');
    }
}
