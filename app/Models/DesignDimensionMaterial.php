<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignDimensionMaterial extends Model
{
    use HasFactory;
    protected $table = 'designs_dimension_materials';
    protected $fillable = [
        'DM_id',
        'design_id',
        'price'
    ];
    public function design()
    {
        return $this->belongsTo(Designes::class, 'design_id');
    }
    public function DM()
    {
        return $this->belongsTo(DimMatModel::class, 'DM_id');
    }
}
