<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViTri extends Model
{
    protected $table="vi_tris";
    public function vitri()
    {
        return $this->hasMany('App\Models\User','id_vi_tri','id');
    }
}
