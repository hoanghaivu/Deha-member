<?php

namespace App\Http\Requests;

use App\Rules\UniqueDivisionRule;
use Illuminate\Foundation\Http\FormRequest;

class DivisionRequest extends FormRequest
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
            'division_name' => ['required', new UniqueDivisionRule],
        ];
        
        return $rules;
    }

    public function messages()
    {
        return [
            'division_name.required' => __('dehaValidation.division.division_name.required'),
        ];
    }
}
