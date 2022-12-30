<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyLoanRequest extends FormRequest
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
            "type"  => "nullable",
            "loaner_name_kh" => "required|max:50",
            "loaner_name_en" => "required|max:50",
            "loaner_sex" => "required",
            "loaner_date_of_birth" => "required",
            "loaner_phone_number" => "required",
            "loaner_document_type" => "required",
            "loaner_document_number" => "required",
            "loaner_province_id" => "required",
            "loaner_district_id" => "required",
            "loaner_commune_id" => "required",
            "loaner_village_id" => "required",
            "first_guarantor_name" => "nullable",
            "first_guarantor_sex" => "nullable",
            "first_guarantor_date_of_birth" => "nullable",
            "first_guarantor_date_of_phone_number" => "nullable",
            "first_guarantor_document_type" => "nullable",
            "first_guarantor_document_number" => "nullable",
            "second_guarantor_name" => "nullable",
            "second_guarantor_sex" => "nullable",
            "second_guarantor_date_of_birth" => "nullable",
            "second_guarantor_phone_number" => "nullable",
            "second_guarantor_document_type" => "nullable",
            "second_guarantor_document_number" => "nullable",
            "staff_id" => "required",
            "principal_amount" => "required",
            "admin_rate" => "required",
            "rate" => "required",
            "registration_date" => "required",
            "started_payment_date" => "required",
            "term" => "required",
            "branch_id" => "required",
            "loan_purpose" => "required",
        ];
    }
}
