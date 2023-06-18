<?php

namespace Vanguard\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest
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
            "title" => 'required',
            "slug" => 'required',
            "status" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => 'សូមបញ្ចូលឈ្មោះទំព័រ',
            "slug.required" => "សូមបញ្ចូល slug",
            "status.required" => "សូមជ្រើសរើសស្ថានភាព",
        ];
    }
}
