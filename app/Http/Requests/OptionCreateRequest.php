<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class OptionCreateRequest extends FormRequest
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
            'label' => 'required',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $contentDefault = $this->request->get('content')[config('constant.language_default_code')];

        $validator->after(function ($validator) use ($contentDefault) {
            if (!$contentDefault) {
                $validator->errors()->add('content', 'Phải nhập content với ngôn ngữ '.config('constant.language_default_code'));
            }
        });
    }
}
