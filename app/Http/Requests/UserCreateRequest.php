<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
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
            'username' => 'required|unique:users|max:50',
            'password' => 'required|max:250',
            'password-confirm' => 'required',
            'status' => 'required',
            'role' => 'required',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $password = $this->request->get('password');
        $passwordConfirm = $this->request->get('password-confirm');

        $validator->after(function ($validator) use ($password, $passwordConfirm) {
            if ($password != $passwordConfirm) {
                $validator->errors()->add('password-confirm', 'Confirm password is not the same as password');
            }
        });
    }
}
