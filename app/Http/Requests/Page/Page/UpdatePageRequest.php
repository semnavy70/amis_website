<?php

namespace Vanguard\Http\Requests\Page\Page;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            "status" => 'required',
            "category_id" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "slug.required" => "សូមបញ្ចូល slug",
            "category_id.required" => "សូមជ្រើសរើសប្រភេទ",
            "status.required" => "សូមជ្រើសរើសស្ថានភាព",
        ];
    }
}
