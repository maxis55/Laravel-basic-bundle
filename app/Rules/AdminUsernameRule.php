<?php

namespace App\Rules;

use App\Models\Users\User;
use Illuminate\Contracts\Validation\Rule;

class AdminUsernameRule implements Rule
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
        $validated_user=User::where([$attribute=>$value])->first();
        return null!==$validated_user && $validated_user->hasRole('superadmin|admin');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.admin_only');
    }
}
