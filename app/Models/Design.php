<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;
    protected $table = "designs";
    protected $fillable = [
        'name',
        'img_url',
        'extra'
    ];
    public function design_dms()
    {
        return $this->hasMany(DesignDimensionMaterial::class, 'design_id');
    }
}
