<?php

namespace Vanguard\Http\Requests\Page\Page;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => 'required',
            "slug" => 'required',
            "category_id" => 'required',
            "status" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => 'សូមបញ្ចូលឈ្មោះទំព័រ',
            "slug.required" => "សូមបញ្ចូល slug",
            "category_id.required" => "សូមជ្រើសរើសប្រភេទ",
            "status.required" => "សូមជ្រើសរើសស្ថានភាព",
        ];
    }
}
