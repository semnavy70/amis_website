<?php

namespace Vanguard\Http\Requests\Post\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "category_id" => 'required',
            "body" => 'required',
            "status" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "slug.required" => "សូមបញ្ចូល Slug",
            "body.required" => "សូមបញ្ចូលអត្ថបទ",
            "category_id.required" => "សូមបញ្ចូលប្រភេទ",
            "status.required" => "សូមបញ្ចូលស្ថានភាព",
        ];
    }
}
