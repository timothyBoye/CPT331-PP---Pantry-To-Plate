<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

/**
 * Class AdminUserFormRequest
 *
 * Request object for validating returned user forms from the admin website
 *
 * @package App\Http\Requests
 */
class AdminUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255|alpha_international',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'user_role_id' => 'required|exists:user_roles,id|integer',
        ];
        if (!(isset($this->id)) || Input::get('password') != '')
        {
            $rules['password'] = 'required|confirmed|max:255|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*]+).*$/';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }
}
