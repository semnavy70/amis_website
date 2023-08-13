<?php

namespace Vanguard\Http\Requests\Document\Document;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => 'required',
            "type" => 'required',
//            "source" => 'required',
            "category_id" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "type.required" => "សូមជ្រើសរើសប្រភេទឯកសារ",
//            "source.required" => "សូមបញ្ចូលឯកសារ",
            "category_id.required" => "សូមជ្រើសរើសប្រភេទ",
        ];
    }
}
