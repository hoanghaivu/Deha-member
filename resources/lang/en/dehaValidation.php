<?php

return [
    'division' => [
        'division_name' => [
            'required' => 'The :attribute is required to enter.',
            'unique' => 'The :attribute is existed.',
        ],
    ],

    'member' => [
        'division_id' => [
            'required' => 'The :attribute has not been selected.'
        ],
        'full_name' => [
            'required' => 'The :attribute field is required.'
        ],
        'gender' => [
            'required' => 'The :attribute has not been selected.'
        ],
        'birthday' => [
            'required' => 'The :attribute has not been selected.'
        ],
        'hometown' => [
            'required' => 'The :attribute field is required.'
        ],
        'start_working_date' => [
            'required' => 'The :attribute has not been selected.'
        ],
        'deha_mail' => [
            'email' => 'The :attribute incorrect format (@deha-soft.com)',
            'unique' => 'The :attribute has already been taken.'
        ],
        'person_mail' => [
            'email' => 'The :attribute incorrect format',
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.'
        ],
        'position' => [
            'required' => 'The position has not been checked.'
        ],
        'mobile' => [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.'
        ],
        'current_accommodation' => [
            'required' => 'The :attribute field is required.'
        ],
        'id_card_member' => [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.'
        ],
        'date_issued' => [
            'required' => 'The :attribute has not been selected.'
        ],
        'place_issued' => [
            'required' => 'The :attribute field is required.'
        ],
        'marital_status' => [
            'required' => 'The :attribute has not been selected.'
        ],
        'education' => [
            'required' => 'The :attribute field is required.'
        ],
    ],
];