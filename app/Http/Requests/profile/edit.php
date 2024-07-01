<?php

namespace App\Http\Requests\profile;

use Illuminate\Foundation\Http\FormRequest;

class edit extends FormRequest
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
            'username' => 'required|string|unique:users,username,' . auth('user')->user()->id,
            'name'     => 'required|string',
            'password' => 'nullable|string',
        ];
    }
}
