<?php

return [
    'label' => 'Destination Price',
    'model' => \App\Models\DmDistrictprices::class,

    // optional, if you want to override the default Table
    //'table' => \App\Http\Livewire\Table\UserCustomTable::class

    'schema' => [
        [
            'name' => 'districtprice_code',
            'type' => \Laravolt\Fields\Field::TEXT,
            'label' => 'Kode Harga',
            'rules' => ['required', 'max:10'],
        ],
        [
            'name' => 'branch_code',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT branch_code as id ,branch_name AS name FROM dm_branches WHERE is_active = 1",
            'label' => 'Cabang Asal',
            'rules' => ['required'],
        ],
        [
            'name' => 'branch_dest_code',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT branch_code as id ,branch_name AS name FROM dm_branches WHERE is_active = 1",
            'label' => 'Cabang Tujuan',
            'rules' => ['required'],
        ],
        [
            'name' => 'district_dest_code',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT district_code as id, district_name AS name FROM dm_districts WHERE is_active = 1",
            'label' => 'Kota Tujuan',
            'rules' => ['required'],
        ],
        [
            'name' => 'service_code',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT code_code as id, code_name AS name FROM dm_codes WHERE code_codegroup = 'SVR' AND is_active = 1",
            'label' => 'Layanan',
            'rules' => ['required'],
        ],
        [
            'name' => 'goods_type_code',
            'type' => \Laravolt\Fields\Field::DROPDOWN_DB,
            'query' => "SELECT code_code as id, code_name AS name FROM dm_codes WHERE code_codegroup = 'SHI' AND is_active = 1",
            'label' => 'Jenis Kiriman',
            'rules' => ['required'],
        ],
        [
            'name' => 'weight',
            'type' => \Laravolt\Fields\Field::NUMBER,
            'label' => 'Berat (Kg)',
        ],
        [
            'name' => 'price',
            'type' => \Laravolt\Fields\Field::RUPIAH,
            'label' => 'Harga (Rp.)',
        ],
        [
            'name' => 'is_active',
            'type' => \Laravolt\Fields\Field::DROPDOWN,
            'label' => 'Status',
            'options' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
        ]
    ],
];

