<?php

namespace App\Http\Requests;

use App\Student;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'session_id'    => 'required',
            'name'          => 'required',
            'surname'       => 'required',
            'fiscal_code'   => 'required|fiscal_code',
            'vat'           => 'required_if:university_code,' . Student::COMPANY,
            'personal_code' => 'required_if:university_code,' . Student::POLYTECHNIC_STUDENT,
            'university_code'=>'required',
            'born_in'       => 'required',
            'province'      => 'required',
            'date_of_birth' => 'required',
            'nation'        => 'required',
            'phone'         => 'required',
            'email'         => 'required|email',
            'university'    => 'required',
            'school'        => 'required_if:university_code,' . Student::OTHER_UNIVERSITY . ',' . Student::POLYTECHNIC_STUDENT,
            'enrolment_exam'=> 'required',
            'matricola'     => 'required_if:university_code,' . Student::OTHER_UNIVERSITY,
        ];
    }
}
