<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'mkelompok';

    public function daerah()
    {
        return $this->hasOne('App\Model\Daerah', 'id_daerah', 'id');
    }

    public function desa()
    {
        return $this->hasOne('App\Model\Desa', 'id_desa', 'id');
    }
}
