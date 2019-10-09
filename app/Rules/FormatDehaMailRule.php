<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FormatDehaMailRule implements Rule
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
        $regex = '/^[a-z][a-z0-9_\.-]+@deha-soft.com+$/';
        return preg_match($regex, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('dehaValidation.member.deha_mail.email');
    }
}
