<?php

return [
    'label' => 'Code',
    'model' => \App\Models\DmCodes::class,

    // optional, if you want to override the default Table
    //'table' => \App\Http\Livewire\Table\UserCustomTable::class

    'schema' => [
        [
            'name' => 'code_codegroup',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT code_code as id ,code_name AS name FROM dm_group_codes WHERE is_active = 1",
            'label' => 'Group Code',
            'rules' => ['required'],
        ],
        [
            'name' => 'code_code',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Code',
            'rules' => ['required'],
        ],
        [
            'name' => 'code_name',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Code Name',
            'rules' => ['required', 'max:30'],
        ],
        [
            'name' => 'code_descr',
            'type' => \Laravolt\Fields\Field::TEXTAREA,
            'label' => 'Descriptions Code',
        ],
        [
            'name' => 'is_active',
            'type' => \Laravolt\Fields\Field::DROPDOWN,
            'label' => 'Status',
            'options' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
        ]
    ],
];

