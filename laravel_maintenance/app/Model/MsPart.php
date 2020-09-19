<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;



class MsPart extends Model
{


    protected $table = 'mspart';
    protected $connection = 'DB-AMS';

    protected $primaryKey = 'AssetID';

    public $timestamps = false;



    // const CREATED_AT = 'CreatedDate';
    // const UPDATED_AT = 'UpdateDate';





};


