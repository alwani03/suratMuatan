<?php

return [
    'label' => 'City',
    'model' => \App\Models\DmDistricts::class,

    // optional, if you want to override the default Table
    //'table' => \App\Http\Livewire\Table\UserCustomTable::class

    'schema' => [
        [
            'name' => 'district_code',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Kode Kota',
            'rules' => ['required', 'max:10'],
        ],
        [
            'name' => 'district_name',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'City Name',
            'rules' => ['required', 'max:30'],
        ],
        [
            'name' => 'branch_code',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT branch_code as id ,branch_name AS name FROM dm_branches WHERE is_active = 1",
            'label' => 'Branch',
            'rules' => ['required'],
        ],
        [
            'name' => 'district_postalcode',
            'type' => \Laravolt\Fields\Field::NUMBER,
            'label' => 'Postal Code',
        ],
        [
            'name' => 'is_active',
            'type' => \Laravolt\Fields\Field::DROPDOWN,
            'label' => 'Status',
            'options' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
        ]
    ],
];

