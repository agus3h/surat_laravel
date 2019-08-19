<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table='keluars';
    protected $guarded=[];


    public function kategori(){
    	return $this->belongsTo(Kategori::class);
    }
}
