<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'price',
        'session',
        'course',
        'variations',
        'session_type_id',
        'course_type_id'
    ];

    public function sessionType()
    {
        return $this->belongsTo(SessionType::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function price()
    {
        return $this->price;
    }

    public function title()
    {
        $title = '€' . $this->price();
        if($this->sessionType) {
            $title .= ' - ' . $this->sessionType->name;
        }
        if($this->courseType) {
            $title .= ' - ' . $this->courseType->name;
        }
        if($this->variations) {
            $title .= ' - ' . $this->variations;
        }

        return $title;
    }

    public function summaryTitlePriceAtTheEnd()
    {
        $title = '';
        if($this->sessionType) {
            $title .= '- ' . $this->sessionType->name;
        }
        if($this->courseType) {
            $title .= ' - ' . $this->courseType->name;
        }
        if($this->variations) {
            $title .= ' - ' . $this->variations;
        }

        return ltrim($title, '-') . " : ";
    }

    public function summaryTitle()
    {
        $title = '';
        if($this->sessionType) {
            $title .= '- ' . $this->sessionType->name;
        }
        if($this->courseType) {
            $title .= ' - ' . $this->courseType->name;
        }
        if($this->variations) {
            $title .= ' - ' . $this->variations;
        }

        return ltrim($title, '-');
    }
}
