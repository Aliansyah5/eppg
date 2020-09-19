<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;



class Masterhourmt extends Model
{


    protected $table = 'master_hourmt';

    //public $timestamps = true;

    protected $fillable = [
        'kode', 'asset', 'HourMeter','user_add','user_modified'
    ];


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';





};


