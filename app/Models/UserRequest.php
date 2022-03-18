<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'design_id',
        'admin_id',
        'status',
        'price'
    ];
    public function user()
    {
        return $this->belongsTo('users', 'user_id');
    }
    public function design()
    {
        return $this->belongsTo('designs', 'design_id');
    }
    public function admin()
    {
        return $this->belongsTo('users', 'admin_id');
    }
}
