<?php

namespace Vanguard\Http\Requests\Podcast\Channel;

use Illuminate\Foundation\Http\FormRequest;

class CreateChannelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => 'required',
            "link" => 'required',
            "copyright" => 'required',
            "author" => 'required',
            "description" => 'required',
            "owner_name" => 'required',
            "owner_email" => 'required',
            "image" => 'required',
            "category" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "link.required" => "សូមបញ្ចូលតំណភ្ជាប់",
            "copyright.required" => "សូមបញ្ចូលរក្សាសិទ្ធ",
            "author.required" => "សូមបញ្ចូលឈ្មោះអ្នកនិពន្ធ",
            "description.required" => "សូមបញ្ចូលពត៌មានលំអិត",
            "owner_name.required" => "សូមបញ្ចូលឈ្មោះម្ចាស់",
            "owner_email.required" => "សូមបញ្ចូលអុីម៉ែលម្ចាស់",
            "image.required" => "សូមបញ្ចូលរូបភាព",
            "category.required" => "សូមបញ្ចូលប្រភេទ",
        ];
    }
}
