<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Member;

class UniqueMemberIdCardRules implements Rule
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
    	
    	return empty(Member::isExistMemberByIdCard(
    		$data['id_card_member'],
		    empty($data['member_id']) ? null : $data['member_id'])
	    );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('dehaValidation.member.id_card_member.unique');
    }
}
