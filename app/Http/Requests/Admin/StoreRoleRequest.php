<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('roles'),
                'string',
                'min:3',
                'max:125'
            ],
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*' => [
                'numeric',
            ]
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
        ]);
    }
}
