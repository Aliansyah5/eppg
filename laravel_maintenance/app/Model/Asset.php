<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;



class Asset extends Model
{

    protected $table = 'master_asset';
    public $timestamps = false;


    public function avianfixasset() {
        return $this->belongsTo('App\Model\AvianFixAsset', 'AssetID','AssetID');
     }


};


