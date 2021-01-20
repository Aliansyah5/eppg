<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Dabsensi extends Model
{
    protected $table = 'dabsensi';

    protected $fillable = ['id','idx','id_siswa','status','jam_datang','keterangan','user_modified'];

}
