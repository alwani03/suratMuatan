<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmDistrictprices extends Model
{
    use HasFactory;

    protected $table = 'dm_districstprice';
    protected $fillable = ['districtprice_code', 'branch_code', 'branch_dest_code', 'district_dest_code', 'service_code', 'goods_type_code', 'weight', 'price', 'created_by', 'updated_by', 'is_active'];

    public function branch()
    {
        return $this->belongsTo('App\Models\MdBranches', 'branch_code', 'branch_code');
    }

    public function branchdest()
    {
        return $this->belongsTo('App\Models\MdBranches', 'branch_dest_code', 'branch_code');
    }

    public function districtdest()
    {
        return $this->belongsTo('App\Models\MdDistricts', 'district_dest_code', 'district_code');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\MdCodes', 'service_code', 'code_code');
    }

    public function goodstype()
    {
        return $this->belongsTo('App\Models\MdCodes', 'goods_type_code', 'code_code');
    }
}
