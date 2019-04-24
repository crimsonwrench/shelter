<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFile extends FormRequest
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
            'files' => 'between:1,3',
            'files.*' => 'mimes:jpeg,jpg,png,gif|max:4096',
        ];
    }

    public function messages()
    {
        return [
            'files.mimes' => 'File should be one of these types: jpeg, jpg, png, gif',
            'files.max' => 'File size should not exceed 4 MB',
            'files.between' => 'You can upload only up to 3 files',
        ];
    }
}
