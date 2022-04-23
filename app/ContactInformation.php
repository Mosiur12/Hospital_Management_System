<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $fillable  = ['facebook', 'twitter', 'instagram', 'youtube', 'whatsapp'];
}
