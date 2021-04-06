<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Admin;

class IsValidPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validate = false;
        switch($attribute) {
            case 'old_password':
                $validate = $this->validateOldPassword($value);
            case 'password':
                $validate = $this->validatePassword($value);
            // case 'confirmed_password':
            //     return $this->validateConfirmedPassword($value);
            default:
                $validate = false;
        }
        if ( ! $validate) {
            return false;
        }
        if ( ! $this->baseValidate($value)) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    protected function baseValidate(string $value)
    {
        $lengthPass = (\Str::length($value) >= 8);
        $isValid = ((bool) preg_match('/^\S*(?=\S{8,25})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $value));
        
        return ($lengthPass && $isValid);
    }

    protected function validateOldPassword(string $value) : bool
    {
        $old_password = (null !== request()->input('old_password'));
        $password = (null !== request()->input('password'));
        $confirmed_password = (null !== request()->input('confirmed_password'));

        if ( ! $old_password && ! $password && ! $confirmed_password) {
            return true;
        }

        $admin_id = request()->input('id');
        $admin = Admin::find($admin_id);
        if (! \Hash::check($value, $admin->password)) {
            return true;
        }
        return false;
    }

    protected function validatePassword(string $value) : bool
    {
        $old_password = (null !== request()->input('old_password'));
        $password = (null !== request()->input('password'));
        $confirmed_password = (null !== request()->input('confirmed_password'));

        if ( ! $old_password && ! $password && ! $confirmed_password) {
            return true;
        }

        if ($old_password === $password) {
            return false;
        }

        if ($password !== $confirmed_password) {
            return false;
        }

        return true;
    }

    protected function checkFilled() : bool
    {
        return 0;
    }
}
