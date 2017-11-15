<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'user_roles';
	protected $primarykey = 'id';
    protected $fillable = [
        'role',
    ];
     public function getUser()
    {
        return $this->hasMany('App\User', 'role_id');
    }
}
