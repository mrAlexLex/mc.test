<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class EmployeeRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:50|regex:/^\S*$/u',
            'surname' => 'required|string|min:2|max:50|regex:/^\S*$/u',
            'patronymic' => 'string||min:2|max:50|regex:/^\S*$/u',
            'gender' => 'required|string',
            'wage' => 'required|numeric|between:0,99999.99',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Обязательное поле для заполнения!',
            'surname.required' => 'Обязательное поле для заполнения!',
            'gender.required' => 'Обязательное поле для заполнения!',
            'wage.required' => 'Обязательное поле для заполнения!'
        ];
    }
}
