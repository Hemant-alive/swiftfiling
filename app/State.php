<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class State extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'states';
	protected $primarykey = 'id';
    protected $fillable = [
        //'name', 'email', 'password',
        'id','name',
    ];

    public function getstate_fees()
    {
		return $this->belongsTo('App\Order', 'foreign_key', 'state_id');
    }
}
