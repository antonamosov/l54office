<?php

return [
    'university_code' => [
        'reformat_type' => 'config',
        'config_file' => 'university_codes'
    ],
    'nation'  => [
        'reformat_type' => 'config',
        'config_file' => 'countries'
    ],
    'province'  => [
        'reformat_type' => 'list',
        'config_file' => 'provinces'
    ],
    'university' => [
        'reformat_type' => 'config',
        'config_file' => 'universities'
    ],
    'session_id' => [
        'reformat_type' => 'model',
    ],
    'city' => [
        'reformat_type' => 'config',
        'config_file' => 'cities'
    ],
    'exam_already_taken' => [
        'reformat_type' => 'boolean'
    ],
    'date_of_birth' => [
        'reformat_type' => 'date'
    ],
    'enrolment_exam' => [
        'reformat_type' => 'date'
    ],
    'updated_at' => [
        'reformat_type' => 'date'
    ],
    'created_at' => [
        'reformat_type' => 'date'
    ],
    'mail_pre_entry_date' => [
        'reformat_type' => 'date'
    ],
    'mail_pre_entry' => [
        'reformat_type' => 'boolean',
        're_name' => 'Pre entry mail was send'
    ],
    'know_us' => [
        'reformat_type' => 'config',
        'config_file' => 'know_us'
    ],
];