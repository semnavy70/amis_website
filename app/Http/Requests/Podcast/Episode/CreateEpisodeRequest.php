<?php

namespace Vanguard\Http\Requests\Podcast\Episode;

use Illuminate\Foundation\Http\FormRequest;

class CreateEpisodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "channel_id" => 'required',
            "title" => 'required',
            "description" => 'required',
            // "enclosure" => 'required',
            "voice" => 'required',
            "duration" => 'required',
            "image" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "សូមបញ្ចូលចំណងជើង",
            "description.required" => "សូមបញ្ចូលពត៌មានលំអិត",
            // "enclosure.required" => "សូមបញ្ចូល Enclosure",
            "voice.required" => "សូមបញ្ចូលសំលេង",
            "duration.required" => "សូមបញ្ចូលរយៈពេល",
            "image.required" => "សូមបញ្ចូលរូបភាព",
        ];
    }
}
