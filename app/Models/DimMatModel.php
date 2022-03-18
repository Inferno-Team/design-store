<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimMatModel extends Model
{
    protected $table = 'dim_mats';
    use HasFactory;
    protected $fillable = [
        'name',
        'dimension_id',
        'material_id',
    ];
    public function dim(){
        return $this->belongsTo(Dimensions::class,'dimension_id');
    }
    public function mat(){
        return $this->belongsTo(Materials::class,'dimension_id');
    }
    
}
