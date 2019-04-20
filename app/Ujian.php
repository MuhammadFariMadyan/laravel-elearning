<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
	protected $table = 'ujians';
    protected $primaryKey = 'id_ujian';

    public function siswa_jawab_pilgans()
    {
    	return $this->hasMany(Siswa::class);
    }

    public function soalhasujian()
    {
        return $this->belongsToMany(\App\Soal::class, 'soal_has_ujians', 'id_soal', 'id_ujian');
        // return $this->hasMany(\App\Soal::class, 'soal_has_ujians', 'id_ujian', 'id_soal');
    }

    
}
