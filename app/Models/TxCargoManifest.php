<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxCargoManifest extends Model
{
    use HasFactory;

    protected $table = 'tx_cargo_manifest';

    protected $fillable = ['cn_no',
        'cn_date',
        'cn_service',
        'cn_goods_type',
        'cn_branch_code',
        'cn_qty',
        'cn_weight',
        'cn_freightcharge_amount',
        'cn_branchdestination_code',
        'cn_destcity',
        'cn_shipper_name',
        'cn_transactionstatus',
        'cn_shipper_adress',
        'cn_shipper_phone',
        'cn_shipper_email',
        'cn_receiver_name',
        'cn_receiver_adress',
        'cn_receiver_phone',
        'cn_receiver_email',
        'created_by',
        'updated_by',
        'is_active'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\DmBranches', 'branch_code', 'branch_code');
    }

    public function branchdest()
    {
        return $this->belongsTo('App\Models\DmBranches', 'cn_branchdestination_code', 'branch_code');
    }

    public function citydest()
    {
        return $this->belongsTo('App\Models\DmDistricts', 'cn_destcity', 'district_code');
    }
}
