<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Admin;

class MatchWithOldPassword implements Rule
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
        if ( ! isset($value) || empty($value) ) {
            return true;
        }
        $admin_id = request()->input('id');
        $admin = Admin::find($admin_id);
        if (isset($admin)) {
            return \Hash::check($value, $admin->password);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong old password.';
    }
}
