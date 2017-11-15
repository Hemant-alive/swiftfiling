<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
	protected $table = 'plans';
	protected $primarykey = 'id';
	protected $fillable = ['title','description','status','slug'];
	 
	public function getplan()
    {
		//echo "sd1";die;
		return $this->belongsTo('App\Order', 'foreign_key', 'plan_id');
    }
}
