<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamCong extends Model
{
    protected $table="cham_congs";
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
}
