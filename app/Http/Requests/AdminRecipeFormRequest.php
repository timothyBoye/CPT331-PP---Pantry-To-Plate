<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'short_description' => 'required|max:255',
            'long_description' => 'required',

            'user_role_id' => 'required|exists:user_roles,id|integer',
        ];

        foreach($this->request->get('methods') as $key => $val)
        {
            $rules['method_'.$key] = 'required';
        }

        return $rules;
    }
}
