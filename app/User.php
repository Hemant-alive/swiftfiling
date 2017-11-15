<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primarykey = 'id';
    protected $foreignkey  = 'role_id';
    protected $fillable = [
        //'name', 'email', 'password',
        'role_id','first_name','last_name','mobile_number', 'status', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   /* protected $hidden = [
        'password', 'remember_token',
    ];*/
    public function userRole()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
}
