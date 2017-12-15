<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdfAttachment extends Model
{
    protected $fillable = [
        'name',
        'body',
        'user_type',
        'email_id'
    ];

    public function Email()
    {
        return $this->belongsTo(Email::class);
    }
}
