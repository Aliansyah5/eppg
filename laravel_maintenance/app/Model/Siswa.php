<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'msiswa';

    public function kelompok()
    {
        return $this->hasOne('App\Model\Kelompok', 'id_kelompok', 'id');
    }

    public function dapukan()
    {
        return $this->hasOne('App\Model\Dapukan', 'id_dapukan', 'id');
    }

    public function kategori()
    {
        return $this->hasOne('App\Model\Kategori', 'id_kategori', 'id');
    }
}
