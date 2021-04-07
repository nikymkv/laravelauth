<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use App\Rules\IsValidPassword;


class StoreAdminRequest extends AdminRequest
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
        return array_merge(parent::rules(), [
            'email' => [
                'required',
                'email',
                Rule::unique('admins'),
                'min:5',
                'max:191',
            ],
            'password' => [
                'required',
                new IsValidPassword(),
                'confirmed:password',
            ],
            'password_confirmation' => [
                'required',
            ],
            'role' => [
                'required',
                'numeric'
            ]
        ]);
    }
}
