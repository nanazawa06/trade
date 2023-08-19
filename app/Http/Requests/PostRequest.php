<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'nullable|max:500',
            'state_id' => 'required',
            //'images.*' => 'mimes:jpg,png,gif|required|min:1',
            'gives.*' => 'required|max:30',
            'wants.*' => 'required|max:30',
            ];
    }
}
