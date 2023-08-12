<?php

namespace Vanguard\Http\Requests\Page\PageCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageCategoryRequest extends FormRequest
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

    public function rules()
    {
        return [
            "name" => 'required',
            "category_id" => 'required',
            "category_id.required" => "សូមជ្រើសរើសប្រភេទ",
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
