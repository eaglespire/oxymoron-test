<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckGuarantorName implements Rule
{
    public $referredField = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $referredField)
    {
        $this->referredField = $referredField;
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
        return ucwords($value) != ucwords(request()->input($this->referredField));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Both Guarantor and Next of kin cannot be the same';
    }
}
