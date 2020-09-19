<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;



class AvianFixAsset extends Model
{


    protected $table = 'masset';
    protected $connection = 'DB-AMS';

    protected $primaryKey = 'AssetID';

    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'UpdateDate';

    public function Dalokasi() {
        return $this->hasOne('App\Model\Dalokasi', 'AssetID','AssetID');
     }

     public function asset() {
        return $this->belongsTo('App\Model\Asset', 'AssetID','AssetID');
     }

     public function dassetmt() {
         return $this->hasMany('App\Model\Dassetmt','AssetID','AssetID');
     }

     public function maintenance() {
        return $this->hasMany('App\Model\Maintenance','asset','AssetID');
    }


};


