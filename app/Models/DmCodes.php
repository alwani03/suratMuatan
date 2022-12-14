<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmCodes extends Model
{
    use HasFactory;

    protected $table = 'dm_codes';
    protected $fillable = ['code_codegroup', 'code_code', 'code_name', 'code_descr', 'created_by', 'updated_by', 'is_active'];

    public function groupcode()
    {
        return $this->belongsTo(MdGroupCodes::class, 'code_codegroup', 'code_code');
    }
}
