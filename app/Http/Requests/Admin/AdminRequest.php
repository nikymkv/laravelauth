<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|string|max:191',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => trim($this->email),
            'old_password' => isset($this->old_password) ? trim($this->old_password) : null,
            'password' => isset($this->password) ? trim($this->password) : null,
            'password_confirmation' => isset($this->password_confirmation) ? trim($this->password_confirmation) : null,
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
}
