<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'max:50',
            'text' => 'max:15000',
            'filename.*' => 'mimes:jpeg,jpg,png,gif,webm|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'Title length should not exceed 50 characters',
            'text.required' => 'A message is required',
            'text.max' => 'Message length should not exceed 15000 characters',
            'filename.mimes' => 'File should be one of these types: jpeg, jpg, png, gif, webm',
            'filename.max' => 'File size should not exceed 2 MB',
        ];
    }
}
