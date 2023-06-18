<?php

namespace Vanguard\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            "video_link" => 'required',
            "author" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "video_link.required" => "សូមបញ្ចូលតំណភ្ជាប់",
            "author.required" => "សូមបញ្ចូលអ្នកនិពន្ធ",
        ];
    }
}
