<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EventRegistration extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

}
