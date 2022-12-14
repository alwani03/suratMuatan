<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmDistricts extends Model
{
    use HasFactory;

    protected $table = 'dm_districts';
    protected $fillable = ['district_code', 'district_name', 'branch_code', 'district_postalcode', 'created_by', 'updated_by', 'is_active'];

    public function branch()
    {
        return $this->belongsTo('App\Models\DmBranches', 'branch_code', 'branch_code');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
