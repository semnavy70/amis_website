<?php

namespace Vanguard\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class CreatePartnerRequest extends FormRequest
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
            "name" => 'required',
            "image" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "សូមបញ្ចូលឈ្មោះដៃគូសហការ",
            "image.required" => "សូមបញ្ចូលរូបភាព",
        ];
    }
}
