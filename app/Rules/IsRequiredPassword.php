<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsRequiredPassword implements Rule
{
    protected $message;
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
        switch($attribute) {
            case 'old_password':
                return $this->requiredOldPassword();
            case 'password':
                return $this->requiredPassword();
            default:
                return false;
        }
    }

    protected function requiredOldPassword() : bool
    {
        $password = ((bool) (request()->input('password') !== null));
        $confirmed_password = ((bool) (request()->input('confirmed_password') !== null));
        $this->message = 'The password and confirmed password is required.';

        return ($password && $confirmed_password);
    }

    protected function requiredPassword() : bool
    {
        $old_password = ((bool) (request()->input('old_password') !== null));
        $confirmed_password = ((bool) (request()->input('confirmed_password') !== null));
        $this->message = 'The tassword and confirmed password is required.';

        return ($old_password && $confirmed_password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
