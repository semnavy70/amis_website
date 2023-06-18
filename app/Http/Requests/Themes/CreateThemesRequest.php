<?php

namespace Vanguard\Http\Requests\Themes;

use Illuminate\Foundation\Http\FormRequest;

class CreateThemesRequest extends FormRequest
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
            "logo" => 'required',
        ];
    }
    public function messages()
    {
        return [
            "logo.required" => "សូមបញ្ចូលនិមិត្តសញ្ញារបស់អ្នក",
        ];
    }
}
