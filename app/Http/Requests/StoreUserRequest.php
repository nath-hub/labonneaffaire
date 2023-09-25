<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        $routeName = $this->route()->getName();

        if($routeName === 'users.avatar'){
            return [
                "avatar"=> "required|image",
            ];
        }

        return [
            "first_name" => "string",
            "last_name" => "string",
            "country" => "string",
            "phone" => "required|integer|unique:users",
            "email" => "required|email|string|unique:users",
            "town" =>"string",
            "password" => "required|string",
            "type_account" => "string",

            "role" => "string",
            "state" => "required|string",
            "birth_date" => "string",
            "avatar"=> "string",

            "name_enterprise" => "sometimes|required_if:type_account, INTERPRISE",
            "siren" => "sometimes|required_if:type_account, INTERPRISE",
            "commercial_register" => "sometimes|required_if:type_account, INTERPRISE",
            "address" => "sometimes|required_if:type_account, INTERPRISE",
            "web_site" => "sometimes|required_if:type_account, INTERPRISE",
           "description" => "sometimes|required_if:type_account, INTERPRISE",
        ];
    }
}
