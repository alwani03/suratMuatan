<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmBranches extends Model
{
    use HasFactory;

    protected $table = 'dm_branches';
    protected $fillable = ['branch_code', 'branch_name', 'branch_address', 'branch_phone', 'created_by', 'updated_by', 'is_active'];
}
