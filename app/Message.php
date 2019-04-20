<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Message extends Model
{
	protected $table = 'messages';
    /**
     * @var array
     */
    protected $dates = ['expired_at'];
}