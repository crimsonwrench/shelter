<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublication extends FormRequest
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
            'title' => 'max:100',
            'text' => 'required|max:15000',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'Title length should not exceed 50 characters',
            'text.required' => 'Message cannot be empty',
            'text.max' => 'Message length should not exceed 15000 characters',
        ];
    }
}
