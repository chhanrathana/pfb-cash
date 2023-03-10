<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'name_kh'           => 'required|max:255',
            'name_en'           => 'required|max:255',
            'sex'               => 'required',
            'phone_number'      => 'required|max:50',
            'date_of_birth'     => 'date_format:d/m/Y',
            'start_work_date'   => 'date_format:d/m/Y',
            'status'            => 'required',
            'born_place'        => 'required|max:250',
            'document_type'     => 'required',
            'document_number'   => 'required|max:50',
            'current_place'     => 'required|max:250',
            'branch_id'         => 'required',
            'emergency_number'  => 'required'
        ];
    }
}
