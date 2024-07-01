<?php

namespace App\Http\Requests\Api\user;

use App\Traits\requestApiTrait;
use App\Traits\response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class changePasswordRequest extends FormRequest
{
    use requestApiTrait;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password'      => 'required|string',
            'password'          => 'required|string|min:6',
            'confirm_password'  => 'required|string|same:password',
        ];
    }
}
