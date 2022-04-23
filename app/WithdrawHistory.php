<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawHistory extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
