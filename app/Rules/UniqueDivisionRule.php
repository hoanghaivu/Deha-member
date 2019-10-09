<?php

namespace App\Rules;

use App\Models\Division;
use Illuminate\Contracts\Validation\Rule;

class UniqueDivisionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    	$data = request()->all();
    	
    	return empty(Division::isExistDivisionByName(
    		$data['division_name'],
		    empty($data['division_id']) ? null : $data['division_id'])
	    );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('dehaValidation.division.division_name.unique');
    }
}
