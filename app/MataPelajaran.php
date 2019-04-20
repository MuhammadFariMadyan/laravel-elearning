<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
	protected $table = 'mata_pelajarans';
    protected $primaryKey = 'id_mapel';  
    // protected $fillable = array('nama_mapel', 'nip_guru'); 
}
