<?php

return [
    /*'auto' => [
        0 => 'Non auto',
        1 => 'Auto after subscription (dynamic)',
        2 => 'Auto after subscription (dynamic, pdf attached)',
        3 => 'Auto if expired'
    ],*/
    'user_type' => [
        0 => 'All students',
        1 => 'Studente Politecnico',
        2 => 'Altro Atento',
        3 => 'Azienda',
        4 => 'Privato'
    ],
    'student_fields' => [
        0 => [
            'field_name' =>  'mail_pre_entry',
            'template_type' =>  1,
            'boolean_exists' => true,
        ],
        1 => [
            'field_name' =>  'mail_confirmed',
            'template_type' =>  2,
            'boolean_exists' => true,
        ],
        2 => [
            'field_name' =>  'mail_expired',
            'template_type' =>  3,
            'boolean_exists' => true,
        ],
        3 => [
            'field_name' =>  'mail_call',
            'template_type' =>  4,
            'boolean_exists' => true,
        ],
        4 => [
            'field_name' =>  'mail_score',
            'template_type' =>  5,
            'boolean_exists' => true,
        ],
        5 => [
            'field_name' =>  'mail_withdrawal',
            'template_type' =>  6,
            'boolean_exists' => true,
        ],
        6 => [
            'field_name' =>  'tan',
            'template_type' =>  7,
            'boolean_exists' => false,
        ],
        7 => [
            'field_name' =>  'tat',
            'template_type' =>  8,
            'boolean_exists' => false,
        ],
        8 => [
            'field_name' =>  'tas',
            'template_type' =>  9,
            'boolean_exists' => false,
        ],
        9 => [
            'field_name' =>  'fts',
            'template_type' =>  10,
            'boolean_exists' => false,
        ],
    ],
    /*
     * Dynamic variables for template (name - name of variable in the template (for example, {surname}), column - name in database (students table))
     */
    'dynamic_variables' => [
        0 => [
            'name'      => 'name',
            'column'    => 'name',
            'default'   => '………………………………………',
            'description' => 'name',
            're_format' => false,
        ],
        1 => [
            'name'      => 'surname',
            'column'    => 'surname',
            'default'   => '………………………………………',
            'description' => 'Congome',
            're_format' => false,
        ],
        2 => [
            'name'      => 'exam_date',
            'column'    => 'enrolment_exam',
            'default'   => '………………………………………',
            'description' => 'Iscrizione Esame del',
            're_format' => 'date',
        ],
        3 => [
            'name'      => 'fiscal_code',
            'column'    => 'fiscal_code',
            'or_column'    => 'vat',
            'default'   => '………………………………………',
            'description' => 'Cod. Fiscale or P.IVA',
            're_format' => false,
        ],
        4 => [
            'name'      => 'born_in',
            'column'    => 'born_in',
            'default'   => '………………………………………',
            'description' => 'Nato a',
            're_format' => false,
        ],
        5 => [
            'name'      => 'province',
            'column'    => 'province',
            'default'   => '………………………………………',
            'description' => 'Provincia',
            're_format' => 'config',
            'config_name' => 'provinces'
        ],
        6 => [
            'name'      => 'date_of_birth',
            'column'    => 'date_of_birth',
            'default'   => '………………………………………',
            'description' => 'Data nascita',
            're_format' => 'date',
        ],
        7 => [
            'name'      => 'number',
            'column'    => 'number',
            'default'   => '………………………………………',
            'description' => 'n',
            're_format' => false,
        ],
        8 => [
            'name'      => 'personal_code',
            'column'    => 'personal_code',
            'default'   => '………………………………………',
            'description' => 'Codice Persona',
            're_format' => false,
        ],
        9 => [
            'name'      => 'city',
            'column'    => 'city',
            'default'   => '………………………………………',
            'description' => 'City',
            're_format' => 'config',
            'config_name' => 'cities'
        ],
        10 => [
            'name'      => 'tan_code',
            'column'    => 'tan',
            'default'   => '………………………………………',
            'description' => 'TAN code',
            're_format' => false,
        ],
        11 => [
            'name'      => 'tat_code',
            'column'    => 'tat',
            'default'   => '………………………………………',
            'description' => 'TAT code',
            're_format' => false,
        ],
        12 => [
            'name'      => 'tas_code',
            'column'    => 'tas',
            'default'   => '………………………………………',
            'description' => 'TAS code',
            're_format' => false,
        ],
        13 => [
            'name'      => 'fts_code',
            'column'    => 'fts',
            'default'   => '………………………………………',
            'description' => 'FTS code',
            're_format' => false,
        ],
        14 => [
            'name' => 'nation',
            'column'    => 'nation',
            'default'   => '………………………………………',
            'description' => 'Nazione',
            're_format' => 'config',
            'config_name' => 'countries'
        ],
        15 => [
            'name' => 'university',
            'column'    => 'university',
            'default'   => '………………………………………',
            'description' => 'Universita',
            're_format' => false,
        ],
        16 => [
            'name' => 'school',
            'column'    => 'school',
            'default'   => '………………………………………',
            'description' => 'Facolta',
            're_format' => false,
        ],
        17 => [
            'name' => 'cap',
            'column'    => 'cap',
            'default'   => '………………………………………',
            'description' => 'Cap',
            're_format' => false,
        ],
        18 => [
            'name' => 'email',
            'column'    => 'email',
            'default'   => '………………………………………',
            'description' => 'E-mail',
            're_format' => false
        ],
        19 => [
            'name' => 'checkbox',
            'column' => false,
            'default' => '<input type="checkbox" style="margin-top:10px; padding-top:10px">',
            'description' => 'checkbox',
            're_format' => false
        ],
        20 => [
            'name' => 'price',
            'column' => false,
            'default' => '0',
            'description' => "Exam price",
            're_format' => 'external_price'
        ],
        21 => [
            'name'      => 'phone',
            'column'    => 'phone',
            'default'   => '………………………………………',
            'description' => 'Telefono',
            're_format' => false,
        ],
        22 => [
            'name'      => 'exam_date_from',
            'column'    => 'exam_date_from',
            'default'   => '',
            'description' => 'Old exam date',
            're_format' => 'date',
        ],
        23 => [
            'name'      => 'exam_date_to',
            'column'    => 'exam_date_to',
            'default'   => '',
            'description' => 'New exam date',
            're_format' => 'date',
        ],
        24 => [
            'name'      => 'listening',
            'column'    => 'listening',
            'default'   => '',
            'description' => 'Listening score',
            're_format' => false,
        ],
        25 => [
            'name'      => 'reading',
            'column'    => 'reading',
            'default'   => '',
            'description' => 'Reading score',
            're_format' => false,
        ],
        26 => [
            'name'      => 'total_score',
            'column'    => 'total_score',
            'default'   => '',
            'description' => 'Total score',
            're_format' => false,
        ],
    ]
];