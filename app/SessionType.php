<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
}
