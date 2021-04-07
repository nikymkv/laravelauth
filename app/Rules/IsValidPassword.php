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
        // return $this->baseValidate($value);
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong password format.';
    }

    protected function baseValidate($value) : bool
    {
        $isValid = ((bool) preg_match('/^\S*(?=\S{8,25})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $value));
        
        return $isValid;
    }
}
