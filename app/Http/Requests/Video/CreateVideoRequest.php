<?php

namespace Vanguard\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class CreateVideoRequest extends FormRequest
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
            "slug" => 'required|unique:videos,slug',
            "video_link" => 'required',
            "image" => 'required',
            "author" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "slug.required" => "សូមបញ្ចូល Slug",
            "video_link.required" => "សូមបញ្ចូលតំណភ្ជាប់",
            "image.required" => "សូមបញ្ចូលរូបភាព",
            "author.required" => "សូមបញ្ចូលអ្នកនិពន្ធ",
        ];
    }
}
