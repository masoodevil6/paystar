<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PostalCode implements Rule
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
        $nationalCode = convertArabicToEnglish($value);
        $nationalCode = convertPersianToEnglish($nationalCode);
        $pattern = "/\b(?!(\d)\1{3})[13-9]{4}[1346-9][013-9]{5}\b/";
        return preg_match($pattern, $nationalCode);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute معتبر نمی باشد';
    }
}
