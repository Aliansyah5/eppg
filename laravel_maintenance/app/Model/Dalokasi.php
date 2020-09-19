<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;



class Dalokasi extends Model
{
    protected $table = 'dalokasi';
    protected $connection = 'DB-AMS';

    public function Avianfixasset() {
        return $this->belongsTo('App\Model\AvianFixAsset', 'AssetID');
     }

};
