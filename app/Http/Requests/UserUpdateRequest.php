<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $segments = explode('/', url()->current());
        $id = end($segments);
        return [
            'username' => [
                'required',
                'max:50',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'max:250',
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
        $password = $this->request->has('password') ? $this->request->get('password') : '';
        $passwordConfirm = $this->request->has('password-confirm') ? $this->request->get('password-confirm') : '';

        $validator->after(function ($validator) use ($password, $passwordConfirm) {
            if (!empty($password)) {
                if (empty($passwordConfirm)) {
                    $validator->errors()->add('password-confirm', 'Confirm password is not the same as password');
                } else {
                    if ($password != $passwordConfirm) {
                        validator->errors()->add('password-confirm', 'Confirm password is not the same as password');
                    }
                }

            }
        });
    }
}
