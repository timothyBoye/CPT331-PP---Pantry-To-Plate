<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RecipeIngredientsFormRequest
 *
 * Request object for validating returned recipe ingredients forms from the admin website
 *
 * @package App\Http\Requests
 */
class RecipeIngredientsFormRequest extends FormRequest
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
            'ingredient_quantities.*' => 'required|numeric',
            'ingredient_measures.*' => 'required|exists:measurement_types,id|integer',
            'ingredient_names.*' => 'required|exists:ingredients,id|integer',
            'ingredient_descriptions.*' => 'alpha_international|nullable'
        ];
    }
}
