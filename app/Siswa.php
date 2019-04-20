<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model

{	
	protected $table = 'siswas';
    protected $primaryKey = 'nisn_siswa';
    // protected $fillable = {
    // 	'nisn_siswa', 'nama_siswa', 'email_siswa', 'no_hp_siswa', 'ttl_siswa', 'jns_kelamin_siswa', 'alamat_siswa', 'kelas_siswa', 'foto_siswa', 'status_siswa', 'id_user', 'id_kelas'
    // }
}
