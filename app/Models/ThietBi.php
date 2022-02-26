<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThietBi extends Model
{
    public $timestamps = false;
    protected $table="thiet_bis";


    public function congty()
    {
        return $this->belongsTo('App\Models\CongTy','id_cong_ty','id');
    }
}
