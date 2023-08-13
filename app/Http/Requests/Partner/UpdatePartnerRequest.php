<?php

namespace Vanguard\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            "id" => 'required',
            "name" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "សូមបញ្ចូលឈ្មោះដៃគូសហការ",
        ];
    }
}
