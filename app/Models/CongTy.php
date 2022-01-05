<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongTy extends Model
{
    public $timestamps = false;
    protected $table="cong_ties";
    public function user()
    {
        return $this->hasMany('App\Models\User','id_cong_ty','id');
    }
    public function thietbi()
    {
        return $this->hasMany('App\Models\ThietBi','id_cong_ty','id');
    }
}
