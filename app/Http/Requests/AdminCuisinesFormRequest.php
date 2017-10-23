<?php

namespace App\Http\Requests;

use App\Http\Middleware\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class AdminCuisinesFormRequest
 *
 * Request object for validating returned cuisine type forms from the admin website
 *
 * @package App\Http\Requests
 */
class AdminCuisinesFormRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'max:255',
                'alpha_international',
                Rule::unique('cuisine_types')->ignore($this->id)
            ],
        ];
    }

}
