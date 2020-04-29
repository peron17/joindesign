<?php

namespace App\Rules;

use App\Discount;
use Illuminate\Contracts\Validation\Rule;

class CheckVoucher implements Rule
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
        $model = Discount::where('discount_code', strtoupper($value))->count();
        return $model > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid voucher code.';
    }
}
