<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table='kategoris';
    protected $guarded=[];


	public function keluar(){
	return $this->hasMany('App\Keluar');
}

	public function masuk(){
	return $this->hasMany('App\Masuk');
}
}
