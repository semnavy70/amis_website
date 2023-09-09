<?php

namespace Vanguard\Http\Requests\Post\PostCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required',
            "slug" => 'required|unique:post_categories,slug,' . $this->id,
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
