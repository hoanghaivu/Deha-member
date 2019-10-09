<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Member;

class UniqueMemberDehaMailRules implements Rule
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
    	
    	return empty(Member::isExistMemberByDehaMail(
    		$data['deha_mail'],
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
        return __('dehaValidation.member.deha_mail.unique');
    }
}
