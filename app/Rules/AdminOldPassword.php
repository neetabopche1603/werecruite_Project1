<?php

namespace App\Rules;

use App\Models\SuperAdmin;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminOldPassword implements Rule
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
        $old_pass = SuperAdmin::where('email',session()->get('user_name'))->first();
        return Hash::check($value, $old_pass->password);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is match with old password.';

    }
}
