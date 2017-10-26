<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AdminMeasurementFormRequest
 *
 * Request object for validating returned measurement type forms from the admin website
 *
 * @package App\Http\Requests
 */
class AdminMeasurementFormRequest extends FormRequest
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
                Rule::unique('measurement_types')->ignore($this->id)
            ],
            'comparable_size' => 'required|integer',
        ];
    }
}
