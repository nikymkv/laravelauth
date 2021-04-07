<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use App\Rules\MatchWithOldPassword;
use App\Rules\IsRequiredPassword;
use App\Rules\IsValidPassword;

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
                'required_with_all:password,password_confirmation',
                new IsValidPassword(),
                new MatchWithOldPassword(),
            ],
            'password' => [
                'required_with:old_password',
                'exclude_if:old_password,null',
                new IsValidPassword(),
                'different:old_password',
                'confirmed:password',
            ],
            'password_confirmation' => [
                'required_with_all:password,old_password',
                'exclude_if:password,null',
            ]
        ]);
    }
}
