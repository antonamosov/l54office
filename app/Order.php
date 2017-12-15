<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'fiscal_code',
        'vat',
        'personal_code',
        'matricola',
        'born_in',
        'date_of_birth',
        'nation',
        'address',
        'street',
        'number',
        'province',
        'phone',
        'email',
        'university',
        'school',
        'enrolment_exam',
        'session_id'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Check if not have created student from subscription
     *
     * @return bool
     */
    public function haveNotStudent()
    {
        $student = Student::whereOrderId($this->id)->first();
        if(!$student) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Get color button
     *
     * @return string
     */
    public function getCreateStudentBtnColor()
    {
        if($this->haveNotStudent()) {
            return 'btn-info';
        }
        else {
            return 'btn-default';
        }
    }

    /**
     * Get student link, edit or create
     *
     * @return string
     */
    public function getStudentLink()
    {
        if($this->haveNotStudent()) {
            return '/order/' . $this->id . '/user/create';
        }
        else {
            return '/user/edit/' . $this->Student->id;
        }
    }

    /**
     * Get title for student create or edit button
     *
     * @return string
     */
    public function getStudentBtnTitle()
    {
        if($this->haveNotStudent()) {
            return 'Create student';
        }
        else {
            return 'Edit student';
        }
    }
}
