<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $casts = [
        'kelompok' => 'array', // Will convarted to (Array)
        'peserta' => 'array', // Will convarted to (Array)
    ];

    // public function setKelompokAttribute($value)
    // {
    //     $this->attributes['kelompok'] = json_encode($value);
    // }

    // public function getKelompokAttribute($value)
    // {
    //     return $this->attributes['kelompok'] = json_decode($value);
    // }

    // public function setPesertaAttribute($value)
    // {
    //     $this->attributes['peserta'] = json_encode($value);
    // }

    // public function getPesertaAttribute($value)
    // {
    //     return $this->attributes['peserta'] = json_decode($value);
    // }
}
