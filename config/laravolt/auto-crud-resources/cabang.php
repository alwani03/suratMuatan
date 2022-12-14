<?php

return [
    'label' => 'Branch',
    'model' => \App\Models\DmBranches::class,

    // optional, if you want to override the default Table
    //'table' => \App\Http\Livewire\Table\UserCustomTable::class

    'schema' => [
        [
            'name' => 'branch_code',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Branch Code',
            'rules' => ['required', 'max:6'],
        ],
        [
            'name' => 'branch_name',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Branch Name',
            'rules' => ['required', 'max:30'],
        ],
        [
            'name' => 'branch_address',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Address',
        ],
        [
            'name' => 'branch_phone',
            'type' => \Laravolt\Fields\Field::NUMBER,
            'label' => 'No.telp',
        ],
        [
            'name' => 'is_active',
            'type' => \Laravolt\Fields\Field::DROPDOWN,
            'label' => 'Status',
            'options' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
        ]
    ],
];

