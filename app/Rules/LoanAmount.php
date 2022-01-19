<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LoanAmount implements Rule
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
        return $value > 0.04 * request()->input($this->referredField);
        //return request()->input($this->referredField) > $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The monthly salary must be greater than 4 % of the loan amount being requested for';
    }

}
