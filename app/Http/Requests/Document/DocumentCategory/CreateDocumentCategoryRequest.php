<?php

namespace Vanguard\Http\Requests\Document\DocumentCategory;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required',
            "slug" => 'required|unique:post_categories,slug',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "សូមបញ្ចូលឈ្មោះ",
            "slug.required" => "សូមបញ្ចូល Slug",
            "slug.unique" => "Slug ជាន់គេ"
        ];
    }
}
