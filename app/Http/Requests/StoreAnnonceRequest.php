<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnonceRequest extends FormRequest
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
            "title" => "required|string",
            "price" => "integer|required",
            "size" => "string",
            "images" => "required|string",
            "description" => "required|string",
            'state_product' => "required|string",
            "color" => "string",
            "localization" => "string",
            'option_discutable' => "boolean",
            'state_property' => "string",
            'type_property' => "string",
            "date_publish" => "date",
            "job_type" => "string",
            'state_job' => "string",
            'availability' => "required|string",
            'state_annonce' => "required|string",
            'categorie_id' => "integer"
        ];
    }
}
