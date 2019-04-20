<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
	protected $table = 'pengumumans';
    protected $primaryKey = 'id_pengumuman';
    // protected $fillable = {
    // 	'judul','deskripsi','author'
    // }
}
