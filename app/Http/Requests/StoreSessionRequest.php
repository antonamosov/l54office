<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'description' => 'required',
            'date' => 'required|date|before:2037-12-30 23:59:59|after:' . date("Y-m-d H:i:s"),
            'time' => 'required',
            'where' => 'required',
            'max' => 'required|numeric'
        ];
    }
}
