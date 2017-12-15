<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'template_id',
        'path',
        'name',
        'type'
    ];
}
