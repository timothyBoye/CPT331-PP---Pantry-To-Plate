<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminRecipeFormRequest
 *
 * Request object for validating returned recipe forms from the admin website
 *
 * @package App\Http\Requests
 */
class AdminRecipeFormRequest extends FormRequest
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
            'name' => 'required|max:255',
            'recipe_source' => 'required|max:255',
            'short_description' => 'required|max:255',
            'long_description' => 'required',
            'serving_size' => 'required|integer',
            'cuisine_type_id' => 'required|exists:cuisine_types,id|integer',
            'image' => 'image',
            'calories' => 'integer|nullable',
            'mg_sodium' => 'integer|nullable',
            'gram_total_fat' => 'numeric|nullable',
            'gram_saturated_fat' => 'numeric|nullable',
            'gram_fibre' => 'numeric|nullable',
            'gram_total_carbohydrates' => 'numeric|nullable',
            'gram_sugar' => 'numeric|nullable',
            'gram_protein' => 'numeric|nullable',
        ];

        return $rules;
    }

}
