<?php

namespace App\Http\Controllers\Admin\Posts\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'name'       => 'required',
            'short_desc' => 'string|max:255',
            'type'       => 'required',
        ];
    }
}
