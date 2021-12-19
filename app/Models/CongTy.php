<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongTy extends Model
{
    protected $table="cong_ties";
    public function congty()
    {
        return $this->hasMany('App\Models\User','id_cong_ty','id');
    }
}
