<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'description',
        'date',
        'time',
        'session_type_id',
        'where',
        'max'
    ];

    protected $dates = [
        'date'
    ];

    protected $table = 'semesters';

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

    public function getDate()
    {
        return date('d/m/Y', strtotime($this->date));
    }

    public function freePlaces()
    {
        $students = Student::whereSessionId($this->id)->get();
        $freePlaces = $this->max - count($students);

        if($freePlaces > 0) {
            return $freePlaces;
        }
        else {
            return 0;
        }
    }

    public function free()
    {
        if($this->freePlaces() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
