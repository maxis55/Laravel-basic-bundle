<?php

namespace App\Http\Requests\Controllers\Admin\Users\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole([Role::SUPER_ADMIN, Role::ADMIN]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => ['required', 'email', 'unique:users,email,' . ($this->route('user')->id ?? 0)],
            'password' => ['nullable', 'min:6'],
            'roles'    => 'required'
        ];
    }
}
