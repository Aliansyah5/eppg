<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'mdesa';

    public function daerah()
    {
        return $this->hasOne('App\Model\Daerah', 'id_daerah', 'id');
    }
}
