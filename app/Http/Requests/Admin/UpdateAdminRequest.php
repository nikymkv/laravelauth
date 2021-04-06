<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use App\Rules\MatchWithOldPassword;
use App\Rules\IsRequiredPassword;

class UpdateAdminRequest extends AdminRequest
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
                Rule::unique('admins')->ignore($this->id),
                'min:5',
                'max:191',
            ],
            'old_password' => [
                new IsRequiredPassword(),
                new MatchWithOldPassword(),
            ],
            'password' => [
                new IsRequiredPassword(),
                'string',
                'min:5',
                'max:32',
                'different:old_password',
            ],
            'confirmed_password' => [
                'same:password',
            ]
        ]);
    }
}
