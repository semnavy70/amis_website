<?php

namespace Vanguard\Http\Requests\Advertise\Advertise;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertiseRequest extends FormRequest
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
            "link" => 'required',
            "blog" => 'required',
            "page" => 'required',
            "is_active" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "សូមបញ្ចូលឈ្មោះ",
            "link.required" => "សូមបញ្ចូលតំណភ្ជាប់",
            "blog.required" => "សូមបញ្ចូលប្លុក",
            "page.required" => "សូមបញ្ចូលទំព័រ",
            "is_active.required" => "សូមជ្រើសរើសស្ថានភាព",
        ];
    }
}
