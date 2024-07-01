<?php

namespace App\Http\Requests\roles;

use Illuminate\Foundation\Http\FormRequest;

class editRequest extends FormRequest
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
            'name' => 'required|string|unique:roles,name,' . $this->id,
            'permissions'   => 'required',
            'description' => 'required|string',
        ];
    }
}
