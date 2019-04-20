<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalHasUjian extends Model
{
    protected $table = 'soal_has_ujians';

    public function soal()
    {
        return $this->belongsTo(\App\Soal::class, 'soals');
    }


    // public function ujian()
    // {
    //     return $this->belongsTo('ujians', 'id_ujian');
    // }

    public function ujian()
    {
        return $this->belongsTo(\App\Ujian::class, 'ujians');
    }
}
