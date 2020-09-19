<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;



class Dassetmt extends Model
{


    protected $table = 'dassetmt';
    protected $connection = 'DB-AMS';

    protected $primaryKey = 'AssetID';

    public $timestamps = false;

    public function mspart() {
        return $this->hasOne('App\Model\MsPart', 'Kode','KodeNAV');
     }

    // const CREATED_AT = 'CreatedDate';
    // const UPDATED_AT = 'UpdateDate';





};


