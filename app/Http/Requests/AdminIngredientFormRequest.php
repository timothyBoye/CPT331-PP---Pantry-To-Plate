<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AdminIngredientFormRequest
 *
 * Request object for validating returned ingredient forms from the admin website
 *
 * @package App\Http\Requests
 */
class AdminIngredientFormRequest extends FormRequest
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
                Rule::unique('ingredients')->ignore($this->id)
                ],
            'ingredient_category_id' => 'required|exists:ingredient_categories,id|integer',
            'ingredient_image' => 'image',
        ];
    }
}
