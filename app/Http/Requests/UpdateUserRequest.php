<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => "sometimes|required|string",
            "last_name" => "sometimes|required|string",
            "country" => "sometimes|required|string",
            "town" =>"sometimes|required|string",
            "type_account" => "sometimes|required|string",

            "birth_date" => "string",

            "name_enterprise" => "sometimes|required_if:type_account, INTERPRISE",
            "siren" => "sometimes|required_if:type_account, INTERPRISE",
            "commercial_register" => "sometimes|required_if:type_account, INTERPRISE",
            "address" => "sometimes|required_if:type_account, INTERPRISE",
            "web_site" => "sometimes|required_if:type_account, INTERPRISE",
           "description" => "sometimes|required_if:type_account, INTERPRISE",
        ];
    }
}
