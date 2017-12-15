<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'vat'           => 'vat',
            'personal_code' => 'required',
            'born_in'       => 'required',
            'province'      => 'required',
            'date_of_birth' => 'required',
            'nation'        => 'required',
            'phone'         => 'required',
            'email'         => 'required',
            'university'    => 'required',
            'school'        => 'required',
            'enrolment_exam'=> 'required'
        ];
    }
}
