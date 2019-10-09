<?php

namespace App\Http\Requests;

use App\Rules\FormatDehaMailRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueMemberDehaMailRules;
use App\Rules\UniqueMemberPersonMailRules;
use App\Rules\UniqueMemberMobileRules;
use App\Rules\UniqueMemberIdCardRules;

class MemberRequest extends FormRequest
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
            'division_id' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'hometown' => 'required',
            'start_working_date' => 'required',
            'deha_mail' => ['nullable', new FormatDehaMailRule, new UniqueMemberDehaMailRules],
            'person_mail' => ['email', 'required', new UniqueMemberPersonMailRules],
            'positions' => 'required',
            'mobile' => ['required', new UniqueMemberMobileRules],
            'current_accommodation' => 'required',
            'id_card_member' => ['required', new UniqueMemberIdCardRules],
            'date_issued' => 'required',
            'place_issued' => 'required',
            'marital_status' => 'required',
            'education' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'division_id.required' => __('dehaValidation.member.division_id.required'),
            'full_name.required' => __('dehaValidation.member.full_name.required'),
            'gender.required' => __('dehaValidation.member.gender.required'),
            'birthday.required' => __('dehaValidation.member.birthday.required'),
            'hometown.required' => __('dehaValidation.member.hometown.required'),
            'start_working_date.required' => __('dehaValidation.member.start_working_date.required'),
            'deha_mail.unique' => __('dehaValidation.member.deha_mail.unique'),
            'person_mail.email' => __('dehaValidation.member.person_mail.email'),
            'person_mail.required' => __('dehaValidation.member.person_mail.required'),
            'person_mail.unique' => __('dehaValidation.member.person_mail.unique'),
            'positions.required' => __('dehaValidation.member.position.required'),
            'mobile.required' => __('dehaValidation.member.mobile.required'),
            'mobile.unique' => __('dehaValidation.member.mobile.unique'),
            'current_accommodation.required' => __('dehaValidation.member.current_accommodation.required'),
            'id_card_member.required' => __('dehaValidation.member.id_card_member.required'),
            'id_card_member.unique' => __('dehaValidation.member.id_card_member.unique'),
            'date_issued.required' => __('dehaValidation.member.date_issued.required'),
            'place_issued.required' => __('dehaValidation.member.place_issued.required'),
            'marital_status.required' => __('dehaValidation.member.marital_status.required'),
            'education.required' => __('dehaValidation.member.education.required'),
        ];
    }
}
