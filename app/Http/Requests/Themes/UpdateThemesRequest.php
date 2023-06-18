<?php

namespace Vanguard\Http\Requests\Themes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThemesRequest extends FormRequest
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
            "site_name" => 'required',
        ];
    }
    public function messages()
    {
        return [
            "site_name.required" => "សូមបញ្ចូលឈ្មោះគេហទំព័ររបស់អ្នក",
        ];
    }
}
