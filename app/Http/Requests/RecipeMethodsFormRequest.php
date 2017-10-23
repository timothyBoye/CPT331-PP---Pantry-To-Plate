<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RecipeMethodsFormRequest
 *
 * Request object for validating returned recipe methods forms from the admin website
 *
 * @package App\Http\Requests
 */
class RecipeMethodsFormRequest extends FormRequest
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
            'method_descriptions.*' => 'required'
        ];
    }
}
