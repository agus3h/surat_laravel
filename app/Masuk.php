<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table='masuks';
    // protected $guarded=[];
    protected $fillable=['id','dari','nomor','perihal','kategori_id','catatan','status','file'];

public function kategori(){
    	return $this->belongsTo(Kategori::class);
    }


}
