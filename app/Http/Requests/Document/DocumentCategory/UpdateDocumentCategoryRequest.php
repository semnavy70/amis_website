<?php

namespace Vanguard\Http\Requests\Document\DocumentCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required',
            "category_id" => 'required',
//            "slug" => 'required'
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "សូមបញ្ចូលឈ្មោះ",
//           "slug.required" => "សូមបញ្ចូល Slug"
        ];
    }

}
