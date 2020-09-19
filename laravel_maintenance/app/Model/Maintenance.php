<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
	protected $table = 'master_mt';
    public $timestamps = false;

    public function detailmt() {
        return $this->hasMany('App\Model\detailmt','assetid','asset');
    }

    public function detail() {
        return $this->hasOne('App\Model\detailmt','id','id');
    }

}

