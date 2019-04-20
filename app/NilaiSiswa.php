<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
	protected $table = 'nilai_siswas';
    protected $primaryKey = 'id_nilai_siswa';
    // protected $fillable = {
    // 	'jenis_nilai','id_tugas','id_ujian','id_mapel','nisn_siswa'
    // }
}
