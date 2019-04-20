<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name', 'username','email', 'password', 'level',
    ];
	
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function siswa(){
        return $this->hasOne(Siswa::class);
    }
}
