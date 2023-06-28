<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'thumbnail' => 'required',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {

        $titles = $this->request->get('title');
        $descriptions = $this->request->get('description');
        $titleDefault = $this->request->get('title')[config('constant.language_default_code')];
        $descriptionDefault = $this->request->get('description')[config('constant.language_default_code')];
        $codeLanguages = [];
        foreach ($titles as $key => $title) {
            array_push($codeLanguages, $key);
        }

        $validator->after(function ($validator) use ($titleDefault, $descriptionDefault, $titles, $descriptions, $codeLanguages) {
            if (!$titleDefault) {
                $validator->errors()->add('title', 'Phải nhập tiêu đề với ngôn ngữ mặc định');
            }
            if (!$descriptionDefault) {
                $validator->errors()->add('description', 'Phải nhập mô tả với ngôn ngữ mặc định');
            }

            foreach ($codeLanguages as $codeLanguage) {
                if ($titles[$codeLanguage]) {
                    if (!$descriptions[$codeLanguage]) {
                        $validator->errors()->add('description', 'Phải nhập mô tả khi tồn tại tiêu đề ('.$codeLanguage.')');
                    }
                }
                if ($descriptions[$codeLanguage]) {
                    if (!$titles[$codeLanguage]) {
                        $validator->errors()->add('title', 'Phải nhập tiêu đề khi tồn tại miêu tả ('.$codeLanguage.')');
                    }
                }
            }
        });
    }
}
