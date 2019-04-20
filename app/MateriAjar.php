<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriAjar extends Model
{
	protected $table = 'materi_ajars';
    protected $primaryKey = 'id_materi_ajar';

    // protected $fillable = {
    // 	'materi_judul','materi_nama','id_mapel'
    // }

    // public function Mapels(){
    // 	return $this->hasMany('App\MataPelajaran');
    // }

    public function Mapel(){
		return $this->hasMany('App\MataPelajaran', 'foreign_key', 'id_mapel');
	}
}
