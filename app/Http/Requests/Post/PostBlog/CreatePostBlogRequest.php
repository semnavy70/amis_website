<?php

namespace Vanguard\Http\Requests\Post\PostBlog;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostBlogRequest extends FormRequest
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
            "slug" => 'required|unique:post_blogs,slug',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "សូមបញ្ចូលឈ្មោះ",
            "slug.required" => "សូមបញ្ចូល Slug"
        ];
    }
}
